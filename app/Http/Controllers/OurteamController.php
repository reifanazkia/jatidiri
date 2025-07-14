<?php

namespace App\Http\Controllers;

use App\Models\Ourteam;
use App\Models\OurteamCategory;
use Illuminate\Http\Request;

class OurteamController extends Controller
{
    public function index()
    {
        $data = Ourteam::with('category')->latest()->get();
        return view('admin.ourteam.index', compact('data'));
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
            'image' => 'required|string',
        ]);

        Ourteam::create($request->all());
        return back()->with('success', 'Team ditambahkan');
    }

    public function show($id)
    {
        $item = Ourteam::with('category')->findOrFail($id);
        return view('admin.ourteam.show', compact('item'));
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
            'image' => 'required|string',
        ]);

        $team = Ourteam::findOrFail($id);
        $team->update($request->all());

        return back()->with('success', 'Team diperbarui');
    }

    public function destroy($id)
    {
        Ourteam::findOrFail($id)->delete();
        return back()->with('success', 'Team dihapus');
    }
}
