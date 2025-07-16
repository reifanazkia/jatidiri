<?php

namespace App\Http\Controllers;

use App\Models\Unggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UnggulanController extends Controller
{
    public function index(Request $request)
    {
        $query = Unggulan::with('program');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $unggulans = $query->latest()->get();
        return view('admin.unggulan.index', compact('unggulans'));
    }

    public function show($slug)
    {
        $unggulan = Unggulan::with('program')->where('slug', $slug)->firstOrFail();
        return view('admin.unggulan.show', compact('unggulan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:750',
            'link' => 'nullable|url',
            'program_id' => 'required|exists:programs,id',
            'home' => 'nullable|boolean',
        ]);

        $data = $request->except('image');
        $data['slug'] = $this->generateUniqueSlug(Str::slug($request->title));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('unggulan', 'public');
        }

        Unggulan::create($data);
        return back()->with('success', 'Unggulan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $unggulan = Unggulan::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:750',
            'link' => 'nullable|url',
            'program_id' => 'required|exists:programs,id',
            'home' => 'nullable|boolean',
        ]);

        $data = $request->except('image');
        $data['slug'] = $this->generateUniqueSlug(Str::slug($request->title), $id);

        if ($request->hasFile('image')) {
            if ($unggulan->image) {
                Storage::disk('public')->delete($unggulan->image);
            }
            $data['image'] = $request->file('image')->store('unggulan', 'public');
        }

        $unggulan->update($data);
        return back()->with('success', 'Unggulan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $unggulan = Unggulan::findOrFail($id);
        if ($unggulan->image) {
            Storage::disk('public')->delete($unggulan->image);
        }

        $unggulan->delete();
        return back()->with('success', 'Unggulan berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        $unggulans = Unggulan::whereIn('id', $request->ids)->get();

        foreach ($unggulans as $unggulan) {
            if ($unggulan->image) {
                Storage::disk('public')->delete($unggulan->image);
            }
            $unggulan->delete();
        }

        return response()->json(['message' => 'Unggulan berhasil dihapus massal.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('unggulan/ckeditor', $filename, 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
    }

    protected function generateUniqueSlug($slug, $exceptId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Unggulan::where('slug', $uniqueSlug)->when($exceptId, function ($q) use ($exceptId) {
            return $q->where('id', '!=', $exceptId);
        })->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }
}
