<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Misi;
use Illuminate\Support\Facades\Storage;

class MisiController extends Controller
{
    public function update(Request $request, $id)
    {
        $misi = Misi::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'misi' => 'nullable|string',
            'image' => 'reqired|image|max:2048',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($misi->image && Storage::disk('public')->exists($misi->image)) {
                Storage::disk('public')->delete($misi->image);
            }
            $data['image'] = $request->file('image')->store('misis', 'public');
        }

        $misi->update($data);

        return redirect()->route('misis.index')->with('success', 'Data misi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $misi = Misi::findOrFail($id);

        if ($misi->image && Storage::disk('public')->exists($misi->image)) {
            Storage::disk('public')->delete($misi->image);
        }

        $misi->delete();

        return redirect()->route('misis.index')->with('success', 'Data misi berhasil dihapus.');
    }

}
