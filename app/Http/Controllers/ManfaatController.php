<?php

namespace App\Http\Controllers;

use App\Models\Manfaat;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManfaatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = Manfaat::with('service')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->get();

        $services = Service::all();

        return view('manfaat.index', compact('data', 'services', 'search'));
    }

    public function create()
    {
        $services = Service::all();
        return view('manfaat.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('image');
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('manfaat', 'public');
        }

        Manfaat::create($data);

        return redirect()->route('manfaat.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $manfaat = Manfaat::findOrFail($id);
        $services = Service::all();

        return view('manfaat.edit', compact('manfaat', 'services'));
    }

    public function update(Request $request, $id)
    {
        $manfaat = Manfaat::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except('image', 'slug');

        if ($manfaat->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        if ($request->hasFile('image')) {
            if ($manfaat->image && Storage::disk('public')->exists($manfaat->image)) {
                Storage::disk('public')->delete($manfaat->image);
            }

            $data['image'] = $request->file('image')->store('manfaat', 'public');
        }

        $manfaat->update($data);

        return redirect()->route('manfaat.index')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $manfaat = Manfaat::findOrFail($id);

        if ($manfaat->image && Storage::disk('public')->exists($manfaat->image)) {
            Storage::disk('public')->delete($manfaat->image);
        }

        $manfaat->delete();

        return redirect()->route('manfaat.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $items = Manfaat::whereIn('id', $request->ids)->get();

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
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/why', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    private function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Manfaat::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
