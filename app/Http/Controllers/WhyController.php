<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Why;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WhyController extends Controller
{
    public function index(Request $request)
    {
        $query = Why::with('service');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $why = $query->latest()->get();

        return view('why_service.index', compact('why'));
    }

    public function create()
    {
        $services = Service::all();
        return view('why_service.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'service_id' => 'required|exists:services,id',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('image');
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('why', 'public');
        }

        Why::create($data);

        return redirect()->route('why.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $why = Why::where('slug', $slug)->firstOrFail();
        return view('why_service.show', compact('why'));
    }

    public function edit($id)
    {
        $why = Why::findOrFail($id);
        $services = Service::all();
        return view('why_service.edit', compact('why', 'services'));
    }

    public function update(Request $request, $id)
    {
        $why = Why::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'service_id' => 'required|exists:services,id',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except(['image', 'slug']);

        if ($why->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        if ($request->hasFile('image')) {
            if ($why->image && Storage::disk('public')->exists($why->image)) {
                Storage::disk('public')->delete($why->image);
            }
            $data['image'] = $request->file('image')->store('why', 'public');
        }

        $why->update($data);

        return redirect()->route('why.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $why = Why::findOrFail($id);

        if ($why->image && Storage::disk('public')->exists($why->image)) {
            Storage::disk('public')->delete($why->image);
        }

        $why->delete();

        return redirect()->route('why.index')->with('success', 'Data berhasil dihapus.');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/why', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Why::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }
}
