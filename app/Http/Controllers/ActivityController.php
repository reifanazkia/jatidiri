<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = Activity::with('service')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })->latest()->get();

        return view('activity.index', compact('search', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('activity.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        $slug = $this->generateUniqueSlug(Str::slug($$request->title));

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bonus', 'public');
        }

        Activity::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath

        ]);

        return redirect()->route('activity.index')->with('seccess', 'Data Berhasil Di Tambahkan');
    }


    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Activity::findOrFail($id);
        $services = Service::all();
        return view('activity.create', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Activity::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title), $data->id);

        if ($request->hasFile('image')) {
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $imagePath = $request->file('image')->store('activity', 'public');
            $data->image = $imagePath;
        }

        $data->update([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $data->image,
        ]);

        return redirect()->route('bonus.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Activity::findOrFail($id);

         if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $data->delete();

            return redirect()->route('activity.index')->with('success', 'Data Berhasil Di Hapus');
    }
  public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $items = Activity::whereIn('id', $request->ids)->get();

        foreach ($items as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
        }

        return response()->json(['message' => 'Semua data berhasil dihapus.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('bonus/ckeditor', 'public');
            $url = asset('storage/' . $path);
            return response()->json(['url' => $url]);
        }
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (
            Activity::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }

}
