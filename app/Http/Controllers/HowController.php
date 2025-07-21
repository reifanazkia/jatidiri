<?php

namespace App\Http\Controllers;

use App\Models\How;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HowController extends Controller
{
    public function index()
    {
        $data = How::with('service')->latest()->get();
        return view('admin.how.index', compact('data'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.how.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title));

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('how', 'public');
        }

        How::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('how.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = How::findOrFail($id);
        $services = Service::all();
        return view('admin.how.edit', compact('data', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = How::findOrFail($id);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = $this->generateUniqueSlug(Str::slug($request->title), $data->id);

        if ($request->hasFile('image')) {
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $imagePath = $request->file('image')->store('how', 'public');
            $data->image = $imagePath;
        }

        $data->update([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $data->image,
        ]);

        return redirect()->route('how.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = How::findOrFail($id);

        if ($data->image && Storage::disk('public')->exists($data->image)) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return redirect()->route('how.index')->with('success', 'Data berhasil dihapus.');
    }

     public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $items = How::whereIn('id', $request->ids)->get();

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
            $path = $file->store('how/ckeditor', 'public');
            $url = asset('storage/' . $path);
            return response()->json(['url' => $url]);
        }
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (
            How::where('slug', $uniqueSlug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
