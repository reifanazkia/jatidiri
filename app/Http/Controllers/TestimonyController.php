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
        $testimonies = Testimony::with('program')->latest()->get();
         if ($request->filled('search')) {
            $testimonies->where('name', 'like', '%' . $request->search . '%');
        }
        return view('admin.testimonies.index', compact('testimonies'));
    }

    public function show($slug)
    {
        $testimony = Testimony::with('program')->where('slug', $slug)->firstOrFail();
        return view('admin.testimonies.show', compact('testimony'));
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
            'program_id', 'name', 'title', 'description', 'yt_link', 'home'
        ]);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonies');
        }

        Testimony::create($data);
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
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
            'program_id', 'name', 'title', 'description', 'yt_link', 'home'
        ]);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($testimony->image) {
                Storage::delete($testimony->image);
            }
            $data['image'] = $request->file('image')->store('testimonies');
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
}
