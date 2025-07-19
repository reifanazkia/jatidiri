<?php

namespace App\Http\Controllers;

use App\Models\Ourteam;
use App\Models\OurteamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurteamController extends Controller
{
    public function index()
    {
        $data = Ourteam::with('category')->latest()->get();
        return view('admin.ourteam.index', compact('data'));
    }

    public function create()
    {
        $categories = OurteamCategory::all();
        return view('admin.ourteam.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ot_id' => 'required|exists:ourteam_categories,id',
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'fb' => 'nullable|string',
            'ig' => 'nullable|string',
            't' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'required|image|max:750',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ourteam', 'public');
        }

        Ourteam::create($data);
        return back()->with('success', 'Team berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = Ourteam::with('category')->findOrFail($id);
        return view('admin.ourteam.show', compact('item'));
    }

    public function edit($id)
    {
        $team = Ourteam::findOrFail($id);
        $categories = OurteamCategory::all();
        return view('admin.ourteam.edit', compact('team', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ot_id' => 'required|exists:ourteam_categories,id',
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'fb' => 'nullable|string',
            'ig' => 'nullable|string',
            't' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'nullable|image|max:750',
        ]);

        $team = Ourteam::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('ourteam', 'public');
        }

        $team->update($data);
        return back()->with('success', 'Team berhasil diperbarui');
    }

    public function destroy($id)
    {
        $team = Ourteam::findOrFail($id);

        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();
        return back()->with('success', 'Team berhasil dihapus');
    }
}
