<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricing;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PricingController extends Controller
{
    // Tampilkan semua pencarian
    public function index(Request $request)
    {
        $query = Pricing::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $pricing = $query->latest()->get();

        return view('pricing.index', compact('pricing'));
    }

    // Simpan agenda baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'program_id' => 'required|string',
            'price' => 'required|string',
            'diskon' => 'nullable|string',
        ]);

        $data = $request->except('image');
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pricing', 'public');
        }

        Pricing::create($data);

        return redirect()->route('pricing.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    // Tampilkan detail agenda berdasarkan slug
    public function show($slug)
    {
        $pricing = Pricing::where('slug', $slug)->firstOrFail();
        return view('pricing.show', compact('pricing'));
    }

    // Update agenda
    public function update(Request $request, $id)
    {
        $pricing = Pricing::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'program_id' => 'required|exists:programs,id',
            'price' => 'required|string',
            'diskon' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['image', 'slug']);

        // Jika title berubah, perbarui slug
        if ($pricing->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        // Ganti gambar jika diupload
        if ($request->hasFile('image')) {
            if ($pricing->image && Storage::disk('public')->exists($pricing->image)) {
                Storage::disk('public')->delete($pricing->image);
            }
            $data['image'] = $request->file('image')->store('pricing', 'public');
        }

        $pricing->update($data);

        return redirect()->route('pricing.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    // Hapus pricing dan gambarnya
    public function destroy($id)
    {
        $pricing = Pricing::findOrFail($id);

        if ($pricing->image && Storage::disk('public')->exists($pricing->image)) {
            Storage::disk('public')->delete($pricing->image);
        }

        $pricing->delete();

        return redirect()->route('pricing.index')->with('success', 'Agenda dan gambarnya berhasil dihapus.');
    }

    // Upload gambar/video dari CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/pricing', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    // Generate slug unik jika sudah ada yang sama
    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Pricing::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $pricings = Pricing::whereIn('id', $request->ids)->get();

        foreach ($pricings as $pricing) {
            if ($pricing->image && Storage::disk('public')->exists($pricing->image)) {
                Storage::disk('public')->delete($pricing->image);
            }
            $pricing->delete();
        }

        return response()->json(['message' => 'Post berhasil dihapus.']);
}

}
