<?php

namespace App\Http\Controllers;

use App\Models\Alasan;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlasanController extends Controller
{
    public function index(Request $request)
    {
        $query = Alasan::with('service');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('service')) {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->service . '%');
            });
        }

        $data = $query->latest()->get();
        return view('alasan.index', compact('data'));
    }

    public function show($slug)
    {
        $data = Alasan::with('service')->where('slug', $slug)->firstOrFail();
        return view('alasan.show', compact('data'));
    }

    public function create()
    {
        $services = Service::all();
        return view('alasan.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('alasan', 'public');
        }

        Alasan::create($validated);

        return redirect()->route('alasan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alasan = Alasan::findOrFail($id); // Assuming your model is named Alasan
        $services = Service::all(); // Assuming you need services for the dropdown

        return view('alasan.edit', compact('alasan', 'services'));
    }
    public function update(Request $request, $id)
    {
        $data = Alasan::findOrFail($id);

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->title !== $data->title) {
            $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title), $data->id);
        }

        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::disk('public')->delete($data->image);
            }
            $validated['image'] = $request->file('image')->store('alasan', 'public');
        }

        $data->update($validated);

        return redirect()->route('alasan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Alasan::findOrFail($id);

        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $items = Alasan::whereIn('id', $request->ids)->get();

        foreach ($items as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
        }

        return response()->json(['message' => 'Semua data berhasil dihapus.']);
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (
            Alasan::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('alasan/ckeditor', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }
}
