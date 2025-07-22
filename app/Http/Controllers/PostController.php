<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        $posts = $query->latest()->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with('category', 'author')->where('slug', $slug)->firstOrFail();
        return view('posts.index', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required',
            'description'  => 'nullable',
            'content'      => 'nullable',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|image|max:750',
            'pub_date'     => 'required|date',
        ]);

        $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title));
        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('post', 'public');
        }

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'required',
            'description'  => 'nullable',
            'content'      => 'nullable',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|image|max:750',
            'pub_date'     => 'required|date',
        ]);

        if ($request->title !== $post->title) {
            $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title), $post->id);
        }

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('post', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $posts = Post::whereIn('id', $request->ids)->get();

        foreach ($posts as $post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->delete();
        }

        return response()->json(['message' => 'Post berhasil dihapus.']);
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $uniqueSlug = $slug;
        $i = 1;

        while (Post::where('slug', $uniqueSlug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }

    // Upload gambar/video dari CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('post/ckeditor', $filename, 'public');

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => asset('storage/' . $path),
            ]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'Upload gagal.']]);
    }
}
