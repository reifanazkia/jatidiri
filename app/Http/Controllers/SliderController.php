<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    // Tampilkan semua slider
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

    // Form tambah slider
    public function create()
    {
        return view('slider.create');
    }

    // Simpan slider baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'program_id' => 'nullable|string',
            'align' => 'nullable|string',
            'button' => 'nullable|string',
            'link' => 'nullable|string',
            'yt_id' => 'nullable|string',
            'home' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['image']);
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        Slider::create($data);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan.');
    }

    // Tampilkan detail berdasarkan slug
    public function show($slug)
    {
        $slider = Slider::where('slug', $slug)->firstOrFail();
        return view('slider.show', compact('slider'));
    }

    // Form edit slider
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('slider.edit', compact('slider'));
    }

    // Update slider
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'program_id' => 'nullable|string',
            'align' => 'nullable|string',
            'button' => 'nullable|string',
            'link' => 'nullable|string',
            'yt_id' => 'nullable|string',
            'home' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['image', 'slug']);

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

    // Hapus slider
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider berhasil dihapus.');
    }

    // Upload gambar via CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/slider', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    // Buat slug unik
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
