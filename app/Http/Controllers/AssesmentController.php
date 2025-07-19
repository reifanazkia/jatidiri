<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssesmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Assesment::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        $facilities = $query->latest()->get();

        return view('assesment.index', compact('facilities'));
    }

    public function create()
    {
        return view('assesment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:750',
        ]);

        $data = $request->except('image');
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assesment', 'public');
        }

        Assesment::create($data);

        return redirect()->route('assesment.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show($slug)
    {
        $facilities = Assesment::where('slug', $slug)->firstOrFail();
        return view('assesment.show', compact('facilities'));
    }

    public function edit($id)
    {
        $facilities = Assesment::findOrFail($id);
        return view('assesment.edit', compact('facilities'));
    }

    public function update(Request $request, string $id)
    {
        $facilities = Assesment::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:750',
        ]);

        $data = $request->except('image', 'slug');

        if ($facilities->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        if ($request->hasFile('image')) {
            if ($facilities->image && Storage::disk('public')->exists($facilities->image)) {
                Storage::disk('public')->delete($facilities->image);
            }

            $data['image'] = $request->file('image')->store('assesment', 'public');
        }

        $facilities->update($data);

        return redirect()->route('assesment.index')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy(string $id)
    {
        $facilities = Assesment::findOrFail($id);

        if ($facilities->image && Storage::disk('public')->exists($facilities->image)) {
            Storage::disk('public')->delete($facilities->image);
        }

        $facilities->delete();

        return redirect()->route('assesment.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $facilities = Assesment::whereIn('id', $request->ids)->get();

        foreach ($facilities as $facility) {
            if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }
            $facility->delete();
        }

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/facilities', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Assesment::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }
}
