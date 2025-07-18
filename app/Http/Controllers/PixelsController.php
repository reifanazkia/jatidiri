<?php

namespace App\Http\Controllers;

use App\Models\Pixels;
use Illuminate\Http\Request;

class PixelsController extends Controller
{
    public function edit($id)
    {
        $data = Pixels::findOrFail($id);
        return view('pixel.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pixels::findOrFail($id);

        $request->validate([
            'pixel_code' => 'nullable|string'
        ]);

        $data->pixel_code = $request->pixelcode;
        $data->save();

        return redirect()->route('pixel.edit', $id)->with('success', 'Data Berhasil Di Update');
    }
}
