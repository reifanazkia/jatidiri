<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Header;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = Header::latest()->get();
        return view('admin.header.index', compact('headers'));
    }

    public function edit($id)
    {
        $header = Header::findOrFail($id);
        return view('admin.header.edit', compact('header'));
    }

    public function update(Request $request, $id)
    {
        $header = Header::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'meta_desc' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('title', 'meta_desc');

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($header->image && file_exists(public_path($header->image))) {
                unlink(public_path($header->image));
            }

            $image = $request->file('image');
            $imageName = time() . '-' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/headers'), $imageName);
            $data['image'] = 'uploads/headers/' . $imageName;
        }

        $header->update($data);

        return redirect()->route('header.index')->with('success', 'Data header berhasil diperbarui.');
    }

      public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ckeditor'), $filename);

            $url = asset('uploads/ckeditor/' . $filename);
            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

   public function destroy($id)
    {
        $header = Header::findOrFail($id);

        if ($header->image && Storage::disk('public')->exists($header->image)) {
            Storage::disk('public')->delete($header->image);
        }

        $header->delete();

        return redirect()->route('header.index')->with('success', 'Agenda dan gambarnya berhasil dihapus.');
    }
}
