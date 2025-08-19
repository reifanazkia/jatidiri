<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BonusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = Bonus::with('service')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('bonus.index', compact('data', 'search'));
    }


    public function create()
    {
        $services = Service::all();
        return view('bonus.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title));

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bonus', 'public');
        }

        Bonus::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('bonus.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = Bonus::findOrFail($id);
        $services = Service::all();
        return view('bonus.edit', compact('data', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = Bonus::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title), $data->id);

        if ($request->hasFile('image')) {
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $imagePath = $request->file('image')->store('bonus', 'public');
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

    public function destroy($id)
{
    try {
        $data = Bonus::findOrFail($id);

        // Delete the image if it exists
        if ($data->image) {
            // Remove 'storage/' prefix if it exists
            $imagePath = str_replace('storage/', '', $data->image);

            // Check if file exists in storage
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bonus service deleted successfully'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete bonus service: ' . $e->getMessage()
        ], 500);
    }
}


    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $items = Bonus::whereIn('id', $request->ids)->get();

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
            Bonus::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
