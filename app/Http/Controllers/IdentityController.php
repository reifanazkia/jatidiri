<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identity;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class IdentityController extends Controller
{
    public function edit($id)
    {
        $identity = Identity::findOrFail($id);
        return view('identity.edit', compact('identity'));
    }

    public function update(Request $request, $id)
    {
        $identity = Identity::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            // ... validasi lainnya tetap sama ...
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:750',
            'favicon' => 'nullable|image|mimes:png,ico|max:750',
        ]);

        $identity->fill($request->except(['logo', 'favicon']));

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($identity->logo) {
                Storage::delete('public/identity/' . $identity->logo);
            }

            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage
            $path = $file->storeAs('public/identity', $filename);

            // Simpan nama file ke database
            $identity->logo = $filename;
        } elseif (!$request->has('existing_logo') && $identity->logo) {
            // Jika logo dihapus (checkbox remove)
            Storage::delete('public/identity/' . $identity->logo);
            $identity->logo = null;
        }

        // Handle Favicon Upload (sama seperti logo)
        if ($request->hasFile('favicon')) {
            if ($identity->favicon) {
                Storage::delete('public/identity/' . $identity->favicon);
            }

            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/identity', $filename);
            $identity->favicon = $filename;
        } elseif (!$request->has('existing_favicon') && $identity->favicon) {
            Storage::delete('public/identity/' . $identity->favicon);
            $identity->favicon = null;
        }

        $identity->save();

        return redirect()->back()->with('success', 'Identitas berhasil diperbarui!')->with('reload', true);
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/identity', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }
}
