<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FaqsController extends Controller
{
    public function index(Request $request)
    {
        $query = Faqs::with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10);
        return view('faqs.index', compact('data'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string'
        ]);

        $data['slug'] = $this->generateUniqueSlug(Str::slug($data['title']));

        Faqs::create($data);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function show(string $slug)
    {
        $data = Faqs::with('category')->where('slug', $slug)->firstOrFail();
        return view('faqs.show', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Faqs::findOrFail($id);
        $categories = Category::all();
        return view('faqs.edit', compact('data', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $faq = Faqs::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string'
        ]);

        $data['slug'] = $this->generateUniqueSlug(Str::slug($data['title']), $faq->id);

        $faq->update($data);

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $faq = Faqs::findOrFail($id);
        $faq->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        Faqs::whereIn('id', $request->ids)->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '-' . $file->getClientOriginalName();
            $path = $file->storeAs('faqs', $filename, 'public');

            return response()->json(['url' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Faqs::where('slug', $uniqueSlug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}

