<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $posts = $query->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with('category', 'author')->where('slug', $slug)->firstOrFail();
        return view('admin.post.show', compact('post'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required',
            'description'  => 'nullable',
            'content'      => 'nullable',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|string',
            'pub_date'     => 'required|date',
        ]);

        $baseSlug = Str::slug($request->title);
        $validated['slug'] = $this->generateUniqueSlug($baseSlug);
        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'required',
            'description'  => 'nullable',
            'content'      => 'nullable',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|string',
            'pub_date'     => 'required|date',
        ]);

        if ($request->title !== $post->title) {
            $baseSlug = Str::slug($request->title);
            $validated['slug'] = $this->generateUniqueSlug($baseSlug, $post->id);
        }

        if ($request->has('image') && $request->image !== $post->image) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
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
            if ($post->image && Storage::disk('public')->exists($post->image)) {
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
            ->exists()) {
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
            $path = $file->storeAs('uploads/post', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }
}
