<?php

namespace App\Http\Controllers;

use App\Models\statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $data = statistik::all();
        return view('statistik.index', compact('data'));
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('statistik.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'pengguna' => 'required|integer',
            'psikologi' => 'required|integer',
            'assesmen' => 'required|integer',
            'konselor' => 'required|integer',
        ]);

        statistik::create($request->all());

        return redirect()->route('statistik.index')->with('success', 'Data berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $statistik = statistik::findOrFail($id);
        return view('statistik.edit', compact('statistik'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'pengguna' => 'required|integer',
            'psikologi' => 'required|integer',
            'assesmen' => 'required|integer',
            'konsoler' => 'required|integer',
        ]);

        $statistik = statistik::findOrFail($id);
        $statistik->update($request->all());

        return redirect()->route('statistik.index')->with('success', 'Data berhasil diperbarui');
    }

    // Hapus data
    public function destroy($id)
    {
        $statistik = statistik::findOrFail($id);
        $statistik->delete();

        return redirect()->route('statistik.index')->with('success', 'Data berhasil dihapus');
    }
}
