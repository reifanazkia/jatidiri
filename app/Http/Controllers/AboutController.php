<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    // Tampilkan semua data
    public function index(Request $request)
    {
        $query = About::query();
        $abouts = $query->latest()->get();

        return view('abouts.index', compact('abouts'));
    }

    // Tampilkan detail berdasarkan slug
    public function show($slug)
    {
        $about = About::where('slug', $slug)->firstOrFail();
        return view('abouts.index', compact('about'));
    }

    // Perbarui data
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image1' => 'required|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:51200',
        ]);

        $data = $request->except(['image1', 'image2', 'video', 'slug']);

        // Slug otomatis kalau title berubah
        if ($about->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        // Handle image1
        if ($request->hasFile('image1')) {
            if ($about->image1 && Storage::disk('public')->exists($about->image1)) {
                Storage::disk('public')->delete($about->image1);
            }
            $data['image1'] = $request->file('image1')->store('abouts', 'public');
        }

        // Handle image2
        if ($request->hasFile('image2')) {
            if ($about->image2 && Storage::disk('public')->exists($about->image2)) {
                Storage::disk('public')->delete($about->image2);
            }
            $data['image2'] = $request->file('image2')->store('abouts', 'public');
        }

        // Handle video
        if ($request->hasFile('video')) {
            if ($about->video && Storage::disk('public')->exists($about->video)) {
                Storage::disk('public')->delete($about->video);
            }
            $data['video'] = $request->file('video')->store('abouts', 'public');
        }

        $about->update($data);

        return redirect()->route('abouts.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $about = About::findOrFail($id);

        foreach (['image1', 'image2', 'video'] as $file) {
            if ($about->$file && Storage::disk('public')->exists($about->$file)) {
                Storage::disk('public')->delete($about->$file);
            }
        }

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'Data berhasil dihapus.');
    }

    // Slug unik
    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (About::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
