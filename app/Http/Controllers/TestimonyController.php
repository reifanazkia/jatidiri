<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonyController extends Controller
{
    public function index(Request $request)
    {
        $testimonies = Testimony::with('program')->latest()->paginate(3);
        if ($request->filled('search')) {
            $testimonies->where('name', 'like', '%' . $request->search . '%');
        }
        return view('testimonies.index', compact('testimonies'));
    }

    public function show($slug)
    {
        $testimony = Testimony::with('program')->where('slug', $slug)->firstOrFail();
        return view('testimonies.show', compact('testimony'));
    }

    public function create()
    {
        // Pastikan kamu memiliki model Program
        $programs = \App\Models\Program::all();

        return view('testimonies.create', compact('programs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:750',
        ]);

        $data = $request->only([
            'program_id',
            'name',
            'title',
            'description',
            'yt_link',
            'home'
        ]);
        $data['slug'] = Str::slug($request->name);

        // Simpan gambar ke storage/public/testimonies
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonies', 'public');
        }

        Testimony::create($data);
        return redirect()->route('testimonies.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $testimony = Testimony::findOrFail($id);
        $programs = Testimony::all(); // Assuming you have a Program model

        return view('testimonies.edit', compact('testimony', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $testimony = Testimony::findOrFail($id);

        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:750',
        ]);

        $data = $request->only([
            'program_id',
            'name',
            'title',
            'description',
            'yt_link',
            'home'
        ]);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($testimony->image) {
                Storage::disk('public')->delete($testimony->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('testimonies', 'public');
        }

        $testimony->update($data);
        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $testimony = Testimony::findOrFail($id);

        if ($testimony->image) {
            Storage::delete($testimony->image);
        }
        $testimony->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function editTitle($id)
    {
        // Ambil data testimony berdasarkan ID
        $testimony = Testimony::findOrFail($id);

        // Kirim ke view editTitle.blade.php
        return view('testimonies.editTitle', compact('testimony'));
    }

    public function updateTitle(Request $request, $id)
    {
        // Validasi input title
        $request->validate([
            'title' => 'required|unique:testimonies,title,' . $id,
        ]);

        // Update data
        $testimony = Testimony::findOrFail($id);
        $testimony->title = $request->title;
        $testimony->save();

        // Redirect ke index dengan pesan sukses
        return redirect()->route('testimonies.index')
            ->with('success', 'Judul testimony berhasil diperbarui!');
    }
}
