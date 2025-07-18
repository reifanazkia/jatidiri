<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identity;
use Illuminate\Support\Facades\File;

class IdentityController extends Controller
{

    public function edit($id)
    {
        $identity = Identity::findOrFail($id);
        return view('admin.identity.edit', compact('identity'));
    }

    public function update(Request $request, $id)
    {
        $identity = Identity::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'yt' => 'nullable|url',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'fb' => 'nullable|string',
            'ig' => 'nullable|string',
            'tt' => 'nullable|string',
            'day_service' => 'nullable|string',
            'time_service' => 'nullable|string',
            'logo' => 'nullable|image|max:300',
            'favicon' => 'nullable|image|max:100', 
        ]);

        $identity->fill($request->except('logo', 'favicon'));

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('identity'), $filename);

            // delete old file
            if ($identity->logo && file_exists(public_path('identity/' . $identity->logo))) {
                unlink(public_path('identity/' . $identity->logo));
            }

            $identity->logo = $filename;
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('identity'), $filename);

            // delete old file
            if ($identity->favicon && file_exists(public_path('identity/' . $identity->favicon))) {
                unlink(public_path('identity/' . $identity->favicon));
            }

            $identity->favicon = $filename;
        }

        $identity->save();

        return redirect()->back()->with('success', 'Identitas berhasil diperbarui!');
    }
}

