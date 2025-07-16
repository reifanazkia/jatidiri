<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    // Tampilkan semua partner
    public function index(Request $request)
    {
        $query = Partner::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $partners = $query->latest()->get();

        return view('partners.index', compact('partners'));
    }

    // Simpan data partner
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'web' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'program_desc' => 'nullable|string',
            'image' => 'nullable|image|max:750',
        ]);

        $data = $request->except('image');
        $baseSlug = Str::slug($request->name);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        Partner::create($data);

        return redirect()->route('partner.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    // Tampilkan detail partner berdasarkan slug
    public function show($slug)
    {
        $partner = Partner::where('slug', $slug)->firstOrFail();
        return view('partners.index', compact('partner'));
    }

    // Update partner
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'web' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'program_desc' => 'nullable|string',
            'image' => 'nullable|image|max:750',
        ]);

        $data = $request->except(['image', 'slug']);

        if ($partner->name !== $request->name) {
            $baseSlug = Str::slug($request->name);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        if ($request->hasFile('image')) {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }
            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partner.index')->with('success', 'Partner berhasil diperbarui.');
    }

    // Hapus partner dan gambar
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }

        $partner->delete();

        return redirect()->route('partner.index')->with('success', 'Partner berhasil dihapus.');
    }

    // Upload gambar dari CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/partners', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    // Generate slug unik
    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Partner::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
