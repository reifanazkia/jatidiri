<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Visi::query();
        $visis = $query->latest()->get();

        return view('visis.index', compact('visis'));
    }

    public function show($slug)
    {
        $visi = Visi::where('slug', $slug)->firstOrFail();
        return view('visis.show', compact('visi'));
    }

    public function update(Request $request, $id)
    {
        $visi = Visi::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['image', 'slug']);

        if ($visi->title !== $request->title) {
            $data['slug'] = $this->generateUniqueSlug(Str::slug($request->title));
        }

        if ($request->hasFile('image')) {
            if ($visi->image && Storage::disk('public')->exists($visi->image)) {
                Storage::disk('public')->delete($visi->image);
            }
            $data['image'] = $request->file('image')->store('visis', 'public');
        }

        $visi->update($data);

        return redirect()->route('visis.index')->with('success', 'Data visi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $visi = Visi::findOrFail($id);

        if ($visi->image && Storage::disk('public')->exists($visi->image)) {
            Storage::disk('public')->delete($visi->image);
        }

        $visi->delete();

        return redirect()->route('visis.index')->with('success', 'Data visi berhasil dihapus.');
    }

    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Visi::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
