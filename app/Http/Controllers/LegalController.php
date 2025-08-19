<?php

namespace App\Http\Controllers;

use App\Models\Legal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalController extends Controller
{
    public function index(Request $request)
    {
        $query = Legal::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $legals = $query->latest()->get();
        return view('legal.index', compact('legals'));
    }

    public function create()
    {
        return view('legal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|max:750'

        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('legal', 'public');
        }

        Legal::create($data);
        return redirect()->route('legal.index')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function show($id)
    {
        $legals = Legal::findOrFail($id);

        return view('legal.index', compact('legals'));
    }

    public function edit($id)
    {
        $legals = Legal::findOrFail($id);
        return view('legal.edit', compact('legals'));
    }

    public function update(Request $request, $id)
    {
        $legals = Legal::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|max:750'

        ]);

        $data = $request->except('image');

        if ($request->has('remove_image') && $legals->image) {
            Storage::disk('public')->delete($legals->image);
        }

        if ($request->hasFile('image')) {
            if ($legals->image && Storage::disk('public')->exists($legals->image)) {
                Storage::disk('public')->delete($legals->image);
            }

            $data['image'] = $request->file('image')->store('legal', 'public');
        }

        $legals->update($data);
        return redirect()->route('legal.index')->with('success', 'Legal certificate berhasil diperbarui.');
    }

    public function destroy($id)
    {

        $legals = Legal::findOrFail($id);
        if ($legals->image && Storage::disk('public')->exists($legals->image)) {
            Storage::disk('public')->delete($legals->image);
        }

        $legals->delete();

        return back()->with('success', 'Data Berhasil Di Hapus');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/legal', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }
}
