<?php

namespace App\Http\Controllers;

use App\Models\Masalah;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MasalahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = Masalah::with('service')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('masalah.index', compact('data', 'search'));
    }


    public function create()
    {
        $services = Service::all();
        return view('masalah.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title));

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('masalah', 'public');
        }

        Masalah::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('masalah.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = Masalah::findOrFail($id);
        $services = Service::all();
        return view('masalah.edit', compact('data', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = Masalah::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title), $data->id);

        if ($request->hasFile('image')) {
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $imagePath = $request->file('image')->store('masalah', 'public');
            $data->image = $imagePath;
        }

        $data->update([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $data->image,
        ]);

        return redirect()->route('masalah.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Masalah::findOrFail($id);

        if ($data->image && Storage::disk('public')->exists($data->image)) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return redirect()->route('masalah.index')->with('success', 'Data berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $items = Masalah::whereIn('id', $request->ids)->get();

        foreach ($items as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
        }

        return response()->json(['message' => 'Semua data berhasil dihapus.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('masalah/ckeditor', 'public');
            $url = asset('storage/' . $path);
            return response()->json(['url' => $url]);
        }
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (
            Masalah::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
