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
        return view('admin.statistik.index', compact('data'));
    }

    // Halaman edit lengkap
    public function edit($id)
    {
        $data = Svg::findOrFail($id);
        return view('admin.svg.edit', compact('data'));
    }

    // Proses update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title1' => 'required|string',
            'data1'  => 'required|numeric',
            // dst. jika kamu mau tambahkan validasi lain
        ]);

        $svg = Svg::findOrFail($id);
        $svg->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
}
