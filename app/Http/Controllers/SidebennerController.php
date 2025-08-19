<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sidebanner;
use App\Models\SideBenner;
use Illuminate\Support\Str;

class SidebennerController extends Controller
{
    public function edit($id)
    {
        $data = SideBenner::findOrFail($id);
        return view('sidebanner.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = SideBenner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:750', // changed from required to nullable
            'link' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($data->image && file_exists(public_path('uploads/sidebanner/' . $data->image))) {
                unlink(public_path('uploads/sidebanner/' . $data->image));
            }

            // Upload gambar baru
            $file = $request->file('image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sidebanner'), $filename);
            $data->image = $filename;
        }

        $data->link = $request->link;
        $data->save();

        return redirect()->route('sidebanner.edit', $id)->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = SideBenner::findOrFail($id);

        if ($data->image && file_exists(public_path('uploads/sidebanner/' . $data->image))) {
            unlink(public_path('uploads/sidebanner/' . $data->image));
        }

        $data->image = null;
        $data->save();

        return redirect()->route('sidebanner.edit', $id)->with('success', 'Gambar berhasil dihapus.');
    }
}
