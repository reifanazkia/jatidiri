<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Svg;

class SvgController extends Controller
{
    // Halaman statistik (tampilan ringkas)
    public function statistik()
    {
        $data = Svg::first(); // Ambil satu-satunya data
        return view('statistik.index', compact('data'));
    }

    // Halaman edit lengkap
    public function edit($id)
    {
        $data = Svg::findOrFail($id);
        return view('svg.edit', compact('data'));
    }

    // Proses update
    public function update(Request $request, $id)
    {
        $request->validate([
            // Data section validation
            'title1' => 'required|string',
            'title2' => 'required|string',
            'title3' => 'required|string',
            'title4' => 'required|string',
            'value1' => 'required|numeric',
            'value2' => 'required|numeric',
            'value3' => 'required|numeric',
            'value4' => 'required|numeric',

            // Values section validation
            'value1' => 'required|string',
            'value2' => 'required|string',
            'value3' => 'required|string',
            'value4' => 'required|string',
            'value5' => 'required|string',
            'value6' => 'required|string',
        ]);

        $svg = Svg::findOrFail($id);
        $svg->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
}
