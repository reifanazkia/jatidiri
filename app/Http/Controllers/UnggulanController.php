<?php

namespace App\Http\Controllers;

use App\Models\Unggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'link' => 'nullable|url',
            'program_id' => 'required|exists:programs,id',
            'home' => 'nullable|boolean',
        ]);

        $data['slug'] = $this->generateUniqueSlug(Str::slug($request->title));
        Unggulan::create($data);

        return back()->with('success', 'Unggulan ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $unggulan = Unggulan::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'link' => 'nullable|url',
            'program_id' => 'required|exists:programs,id',
            'home' => 'nullable|boolean',
        ]);

        $slug = Str::slug($request->title);
        $i = 1;
        $uniqueSlug = $slug;
        while (Unggulan::where('slug', $uniqueSlug)->where('id', '!=', $id)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        $data['slug'] = $uniqueSlug;

        $unggulan->update($data);
        return back()->with('success', 'Unggulan diperbarui');
    }

    public function destroy($id)
    {
        $unggulan = Unggulan::findOrFail($id);
        if ($unggulan->image && File::exists(public_path('storage/' . $unggulan->image))) {
            File::delete(public_path('storage/' . $unggulan->image));
        }

        $unggulan->delete();
        return back()->with('success', 'Unggulan dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        $unggulans = Unggulan::whereIn('id', $request->ids)->get();

        foreach ($unggulans as $unggulan) {
            if ($unggulan->image && File::exists(public_path('storage/' . $unggulan->image))) {
                File::delete(public_path('storage/' . $unggulan->image));
            }
            $unggulan->delete();
        }

        return response()->json(['message' => 'Unggulan berhasil dihapus secara massal.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/unggulan', $filename, 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
    }

    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Unggulan::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }
}

