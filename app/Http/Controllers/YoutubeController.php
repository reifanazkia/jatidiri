<?php

namespace App\Http\Controllers;

use App\Models\Yutub;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index()
    {
        $data = Yutub::latest()->get();
        return view('admin.yutub.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate(['link' => 'required|url']);
        Yutub::create($request->all());
        return back()->with('success', 'Link YT ditambahkan');
    }

    public function show($id)
    {
        $yt = Yutub::with('programs')->findOrFail($id);
        return view('admin.yutub.show', compact('yt'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['link' => 'required|url']);
        Yutub::findOrFail($id)->update($request->all());
        return back()->with('success', 'Link YT diperbarui');
    }

    public function destroy($id)
    {
        Yutub::findOrFail($id)->delete();
        return back()->with('success', 'YT dihapus');
    }
}

