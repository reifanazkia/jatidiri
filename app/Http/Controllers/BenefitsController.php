<?php

namespace App\Http\Controllers;

use App\Models\Benefits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BenefitsController extends Controller
{
    public function index(Request $request)
    {
        $query = Benefits::with('facility');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $benefits = $query->latest()->get();
        return view('benefits.index', compact('benefits'));
    }

    public function create()
    {
        return view('benefits.create');
    }

    public function show($slug)
    {
        $benefit = Benefits::with('facility')->where('slug', $slug)->firstOrFail();
        return view('benefits.show', compact('benefit'));
    }

    public function edit($id)
    {
        $benefit = Benefits::findOrFail($id);
        return view('benefits.edit', compact('benefit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|unique:benefits,title',
            'description' => 'required',
            'facility_id' => 'required|exists:facilities,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title));
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('benefits', 'public');
        }

        Benefits::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'description' => $request->description,
            'facility_id' => $request->facility_id,
            'home'        => $request->has('home') ? 1 : 0,
            'image'       => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Benefit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $benefit = Benefits::findOrFail($id);

        $request->validate([
            'title'       => 'required|unique:benefits,title,' . $id,
            'description' => 'required',
            'facility_id' => 'required|exists:facilities,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($benefit->image && Storage::disk('public')->exists($benefit->image)) {
                Storage::disk('public')->delete($benefit->image);
            }

            $benefit->image = $request->file('image')->store('benefits', 'public');
        }

        $benefit->title = $request->title;
        $benefit->slug = $this->generateUniqueSlug(Str::slug($request->title), $id);
        $benefit->description = $request->description;
        $benefit->facility_id = $request->facility_id;
        $benefit->home = $request->has('home') ? 1 : 0;
        $benefit->save();

        return redirect()->back()->with('success', 'Benefit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $benefit = Benefits::findOrFail($id);

        if ($benefit->image && Storage::disk('public')->exists($benefit->image)) {
            Storage::disk('public')->delete($benefit->image);
        }

        $benefit->delete();

        return redirect()->back()->with('success', 'Benefit berhasil dihapus.');
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Benefits::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/benefit', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }
}
