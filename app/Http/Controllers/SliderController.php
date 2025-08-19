<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    // Display all sliders
    public function index(Request $request)
    {
        $query = Slider::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $sliders = $query->latest()->get();

        return view('slider.index', compact('sliders'));
    }

    // Show create form
    public function create()
    {
        $programs = Program::all();
        return view('slider.create', compact('programs'));
    }

    // Store new slider
    public function store(Request $request)
    {
        $request->validate([
            'home' => 'nullable|boolean',
            'title' => 'required|max:255',
            'program_id' => 'required|exists:programs,id',
            'description' => 'nullable',
            'align' => 'nullable|string|in:left,center,right',
            'button' => 'nullable|string',
            'link' => 'nullable|string',
            'yt_id' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['image']);
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        // Handle home checkbox
        $data['home'] = $request->has('home') ? 1 : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        Slider::create($data);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    // Show slider details
    public function show($slug)
    {
        $slider = Slider::where('slug', $slug)->firstOrFail();
        return view('slider.show', compact('slider'));
    }

    // Show edit form
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $programs = Program::all();
        return view('slider.edit', compact('slider', 'programs'));
    }

    // Update slider
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'program_id' => 'required|exists:programs,id',
            'align' => 'nullable|string|in:left,center,right',
            'button' => 'nullable|string',
            'link' => 'nullable|string',
            'yt_id' => 'nullable|string',
            'home' => 'nullable|boolean',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['image', 'slug']);

        // Handle home checkbox
        $data['home'] = $request->has('home') ? 1 : 0;

        if ($slider->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        if ($request->hasFile('image')) {
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        $slider->update($data);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil diperbarui.');
    }

    // Delete slider
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider berhasil dihapus.');
    }

    // Upload image via CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $request->validate([
                'upload' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/slider', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    // Generate unique slug
    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Slider::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
