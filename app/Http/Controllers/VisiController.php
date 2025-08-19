<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visi;
use Illuminate\Support\Facades\Storage;

class VisiController extends Controller
{
    public function index()
    {
        $visis = Visi::latest()->get(); // atau ->paginate(10) jika ingin pagination
        return view('visi.index', compact('visis'));
    }

    public function edit($id)
    {
        $visi = Visi::findOrFail($id);
        return view('visi.edit', compact('visi'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'visi' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:750',
    ]);

    $visi = Visi::findOrFail($id);

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($visi->image) {
            Storage::delete($visi->image);
        }

        $validated['image'] = $request->file('image')->store('visi-images');
    }

    $visi->update($validated);

    // Redirect dengan data fresh dari database
    return redirect()->route('visi.index', $visi->id)
        ->with('success', 'Visi updated successfully')
        ->with('visi', $visi->fresh()); // Ambil data terbaru dari database
}

    public function destroy($id)
    {
        $visis = Visi::findOrFail($id);

        if ($visis->image && Storage::disk('public')->exists($visis->image)) {
            Storage::disk('public')->delete($visis->image);
        }

        $visis->delete();

        return redirect()->route('visi.index')->with('success', 'Data visi berhasil dihapus.');
    }
}
