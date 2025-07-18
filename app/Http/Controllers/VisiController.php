<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visi;
use Illuminate\Support\Facades\Storage;

class VisiController extends Controller
{

    public function update(Request $request, $id)
    {
        $visi = Visi::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['image']);

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

}
