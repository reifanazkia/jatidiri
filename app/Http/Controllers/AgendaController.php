<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $query = Agenda::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $agendas = $query->latest()->paginate(10);

        return view('agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'content' => 'required',
            'location' => 'nullable|string|max:255',
            'yt_link' => 'nullable|url',
            'organizer' => 'nullable|string|max:255',
            'register_link' => 'nullable|url',
            'contact' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('agenda', 'public');
                $validated['image'] = $imagePath;
            }

            // Generate slug
            $validated['slug'] = $this->generateUniqueSlug(Str::slug($request->title));

            // Create agenda
            Agenda::create($validated);

            return redirect()->route('agenda.index')
                ->with('success', 'Agenda created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating agenda: ' . $e->getMessage());
        }
    }

    public function show($slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();
        return view('agenda.show', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id); // Pastikan model Agenda di-import
        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // tambahkan validasi untuk field lainnya
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($agenda->image && Storage::exists($agenda->image)) {
                Storage::delete($agenda->image);
            }

            $path = $request->file('image')->store('agenda_images');
            $validated['image'] = $path;
        } elseif ($request->has('remove_image')) {
            // Hapus gambar jika checkbox dicentang
            if ($agenda->image && Storage::exists($agenda->image)) {
                Storage::delete($agenda->image);
            }
            $validated['image'] = null;
        }

        $agenda->update($validated);

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
{
    try {
        $agenda = Agenda::findOrFail($id);

        // Hapus file gambar jika ada
        if ($agenda->image && Storage::exists('public/' . $agenda->image)) {
            Storage::delete('public/' . $agenda->image);
        }

        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Agenda deleted successfully');
    } catch (\Exception $e) {
        return redirect()->route('agenda.index')
            ->with('error', 'Error deleting agenda: '.$e->getMessage());
    }
}

    protected function generateUniqueSlug($slug)
    {
        $original = $slug;
        $count = 1;

        while (Agenda::where('slug', $slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }
}
