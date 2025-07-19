<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    // Tampilkan semua agenda + pencarian
    public function index(Request $request)
    {
        $query = Agenda::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $agendas = $query->latest()->get();

        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    // Simpan agenda baru
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'agendacat'     => 'nullable|string|max:255',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'start_time'    => 'required',
            'end_time'      => 'nullable',
            'content'       => 'required',
            'location'      => 'nullable|string|max:255',
            'yt_link'       => 'nullable|url',
            'organizer'     => 'nullable|string|max:255',
            'register_link' => 'nullable|url',
            'contact'       => 'nullable|string|max:255',
            'image'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('image');
        $baseSlug = Str::slug($request->title);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('agenda', 'public');
        }

        Agenda::create($data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    // Tampilkan detail agenda berdasarkan slug
    public function show($slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();
        return view('admin.agenda.show', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'title'         => 'required|string|max:255',
            'agendacat'     => 'nullable|string|max:255',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'start_time'    => 'required',
            'end_time'      => 'nullable',
            'content'       => 'required',
            'location'      => 'nullable|string|max:255',
            'yt_link'       => 'nullable|url',
            'organizer'     => 'nullable|string|max:255',
            'register_link' => 'nullable|url',
            'contact'       => 'nullable|string|max:255',
            'image'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['image', 'slug']);

        // Slug otomatis jika title berubah
        if ($agenda->title !== $request->title) {
            $baseSlug = Str::slug($request->title);
            $data['slug'] = $this->generateUniqueSlug($baseSlug);
        }

        // Ganti gambar jika upload baru
        if ($request->hasFile('image')) {
            if ($agenda->image && Storage::disk('public')->exists($agenda->image)) {
                Storage::disk('public')->delete($agenda->image);
            }
            $data['image'] = $request->file('image')->store('agenda', 'public');
        }

        $agenda->update($data);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }


    // Hapus agenda dan gambarnya
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        if ($agenda->image && Storage::disk('public')->exists($agenda->image)) {
            Storage::disk('public')->delete($agenda->image);
        }

        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda dan gambarnya berhasil dihapus.');
    }

    // Upload gambar/video dari CKEditor
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/agenda', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    // Generate slug unik jika sudah ada yang sama
    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Agenda::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }
}
