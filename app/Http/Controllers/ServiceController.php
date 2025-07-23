<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $services = $query->latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|max:255',
            'title1'       => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'image1'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title2'       => 'nullable|string|max:255',
            'description2' => 'nullable|string',
            'image2'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title3'       => 'nullable|string|max:255',
            'description3' => 'nullable|string',
            'image3'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title4'       => 'nullable|string|max:255',
            'description4' => 'nullable|string',
            'image4'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['image1', 'image2', 'image3', 'image4']);
        $data['slug'] = $this->generateUniqueSlug(Str::slug($request->name));

        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                $data['image' . $i] = $request->file('image' . $i)->store('services', 'public');
            }
        }

        Service::create($data);

        return redirect()->route('service.index')->with('success', 'Service berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('service.show', compact('service'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name'         => 'required|max:255',
            'title1'       => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'image1'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title2'       => 'nullable|string|max:255',
            'description2' => 'nullable|string',
            'image2'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title3'       => 'nullable|string|max:255',
            'description3' => 'nullable|string',
            'image3'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title4'       => 'nullable|string|max:255',
            'description4' => 'nullable|string',
            'image4'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['image1', 'image2', 'image3', 'image4', 'slug']);

        if ($service->name !== $request->name) {
            $data['slug'] = $this->generateUniqueSlug(Str::slug($request->name));
        }

        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile('image' . $i)) {
                if ($service->{'image' . $i} && Storage::disk('public')->exists($service->{'image' . $i})) {
                    Storage::disk('public')->delete($service->{'image' . $i});
                }
                $data['image' . $i] = $request->file('image' . $i)->store('services', 'public');
            }
        }

        $service->update($data);

        return redirect()->route('service.index')->with('success', 'Service berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        for ($i = 1; $i <= 4; $i++) {
            if ($service->{'image' . $i} && Storage::disk('public')->exists($service->{'image' . $i})) {
                Storage::disk('public')->delete($service->{'image' . $i});
            }
        }

        $service->delete();

        return redirect()->route('service.index')->with('success', 'Service berhasil dihapus.');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/services', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Service::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
