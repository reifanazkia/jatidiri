<?php

namespace App\Http\Controllers;

use App\Models\Dukungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DukunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query =Dukungan::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('title', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10);
        return view('dukungan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'id_yt' => 'nullable|string|max:255',
            'image' => 'required|image|max:755'

        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('dukungan', 'public');
        }

          $data['slug'] = Str::slug($data['name']) . '-' . uniqid();

          Dukungan::create($data);
          return back()->with('success', 'Data Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $data = Dukungan::where('slug', $slug)->firstOrFail();
        return view('dukungan.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, string $id)
    {
        $dukungan = Dukungan::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'id_yt' => 'nullable|string|max:255',
            'image' => 'required|image|max:755'

        ]);

        if ($request->hasFile('image')) {
            if ($dukungan->image && Storage::disk('public')->exists($dukungan->image)) {
                Storage::disk('public')->delete($dukungan->image);
            }

            $data['image'] = $request->file('image')->store('dukungan', 'public');

        }

        $dukungan->update('$data');
        return back()->with('success', 'Data Berhasil Di Perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dukungan = Dukungan::findOrFail($id);

        if ($dukungan->image && Storage::disk('public')->exists($dukungan->image)) {
            Storage::disk('public')->delete($dukungan->image);
        }
    }

     protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Dukungan::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $dukungan = Dukungan::whereIn('id', $request->ids)->get();

        foreach ($dukungan as $item) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->imgae);
            }

            $item->delete();
        }

        return response()->json(['message', 'Data Dukungan Berhasil Di Hapus']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('dukungan', $filename, 'public');
        }

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);

    }
}
