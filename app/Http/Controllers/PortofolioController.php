<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $data = Portofolio::with('program',)->latest()->get();
        return view('admin.portfolio.index', compact('data'));
    }

    public function show($slug)
    {
        $item = Portofolio::with('program')->where('slug', $slug)->firstOrFail();
        return view('admin.portfolio.show', compact('item'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_id' => 'required|exists:programs,id',
            'home' => 'nullable|boolean',
            'logo' => 'nullable|image|max:750',
            'image1' => 'required|image|max:750',
            'image2' => 'nullable|image|max:750',
            'image3' => 'nullable|image|max:750',
            'image4' => 'nullable|image|max:750',
            'yt_id' => 'nullable|string',
        ]);

        $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title));

        foreach (['logo', 'image1', 'image2', 'image3', 'image4'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('portfolio', 'public');
            }
        }

        Portofolio::create($validated);
        return back()->with('success', 'Portfolio ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portofolio::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_id' => 'required|exists:programs,id',
            'home' => 'nullable|boolean',
            'logo' => 'nullable|image|max:750',
            'image1' => 'required|image|max:750',
            'image2' => 'nullable|image|max:750',
            'image3' => 'nullable|image|max:750',
            'image4' => 'nullable|image|max:750',
            'yt_id' => 'nullable|string',
        ]);

        if ($request->title !== $portfolio->title) {
            $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title), $portfolio->id);
        }

        foreach (['logo', 'image1', 'image2', 'image3', 'image4'] as $field) {
            if ($request->hasFile($field)) {
                if ($portfolio->$field) {
                    Storage::disk('public')->delete($portfolio->$field);
                }
                $validated[$field] = $request->file($field)->store('portfolio', 'public');
            }
        }

        $portfolio->update($validated);
        return back()->with('success', 'Portfolio diperbarui.');
    }

    public function destroy($id)
    {
        $portfolio = Portofolio::findOrFail($id);

        foreach (['logo', 'image1', 'image2', 'image3', 'image4'] as $field) {
            if ($portfolio->$field) {
                Storage::disk('public')->delete($portfolio->$field);
            }
        }

        $portfolio->delete();
        return back()->with('success', 'Portfolio dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
        ]);

        $portfolios = Portofolio::whereIn('id', $request->ids)->get();

        foreach ($portfolios as $portfolio) {
            foreach (['logo', 'image1', 'image2', 'image3', 'image4'] as $field) {
                if ($portfolio->$field && Storage::disk('public')->exists($portfolio->$field)) {
                    Storage::disk('public')->delete($portfolio->$field);
                }
            }
            $portfolio->delete();
        }

        return response()->json(['message' => 'Portfolios berhasil dihapus.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('portfolio/ckeditor', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Portofolio::where('slug', $uniqueSlug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
