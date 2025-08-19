<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Ourteam;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $programs = Program::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('category', 'like', "%{$search}%"))
            ->paginate(10)
            ->withQueryString();

        return view('program.index', compact('programs', 'search'));
    }

    // Hanya 1x create
    public function create()
    {
        $outreams = Ourteam::all();
        $facilities = Assesment::all();
        return view('program.create', compact('outreams', 'facilities'));
    }

    public function store(Request $req)
    {
        $rules = [
            // Step 1
            'name' => 'required|string',
            'category' => 'nullable|string',
            'slug' => 'nullable|string',
            'ourteam_id' => 'nullable|exists:outreams,id',
            'facility_id' => 'nullable|exists:facilities,id',
            'title1' => 'nullable|string',
            'description1' => 'nullable|string',
            'image1' => 'nullable|image|max:750',

            // Step 2
            'title2' => 'required|string',
            'description2' => 'required|string',
            'title3' => 'required|string',
            'description3' => 'required|string',
            'image2' => 'nullable|image|max:750',
            'image3' => 'nullable|image|max:750',

            // Step 3
            'title4' => 'required|string',
            'description4' => 'required|string',
            'age' => 'required|string',
            'weekly' => 'required|string',
            'periode' => 'required|string',
            'class_size' => 'required|string',
            'time_table2' => 'nullable|string',
            'content' => 'nullable|string',
            'cta' => 'nullable|string',
            'link_program' => 'nullable|string',
            'id_yt' => 'nullable|string',
            'image4' => 'nullable|image|max:750',
            'brosur' => 'nullable|file|max:2048',
        ];

        $validated = $req->validate($rules);
        $validated['slug'] = Str::slug($validated['name']);

        // Upload gambar
        foreach (['image1', 'image2', 'image3', 'image4'] as $img) {
            if ($req->hasFile($img)) {
                $validated[$img] = $req->file($img)->store('programs', 'public');
            }
        }

        // Upload brosur
        if ($req->hasFile('brosur')) {
            $validated['brosur'] = $req->file('brosur')->store('brosurs', 'public');
        }

        Program::create($validated);

        return redirect()->route('program.index')->with('success', 'Program berhasil dibuat!');
    }

    public function destroy(string $id)
    {
        $p = Program::findOrFail($id);
        foreach (['image1', 'image2', 'image3', 'image4', 'brosur'] as $field) {
            if ($p->$field) Storage::disk('public')->delete($p->$field);
        }
        $p->delete();
        return redirect()->route('program.index')->with('success', 'Program dihapus lengkap dengan file.');
    }

    public function edit(string $id)
    {
        $program = Program::findOrFail($id);
        $outreams = Ourteam::all();
        $facilities = Assesment::all();

        return view('program.edit', compact('program', 'outreams', 'facilities'));
    }

    public function update(Request $req, string $id)
    {
        $rules = [
            // Step 1
            'name' => 'required|string',
            'slug' => 'nullable|string',
            'ourteam_id' => 'nullable|exists:ourteams,id',
            'facility_id' => 'nullable|array',
            'facility_id.*' => 'exists:facilities,id',
            'title1' => 'nullable|string',
            'description1' => 'nullable|string',
            'image1' => 'nullable|image|max:750',

            // Step 2
            'supporting' => 'nullable|array',
            'title2' => 'required|string',
            'description2' => 'required|string',
            'title3' => 'required|string',
            'description3' => 'required|string',
            'image2' => 'nullable|image|max:750',
            'image3' => 'nullable|image|max:750',

            // Step 3
            'title4' => 'required|string',
            'description4' => 'required|string',
            'age' => 'required|string',
            'weekly' => 'required|string',
            'periode' => 'required|string',
            'class_size' => 'required|string',
            'time_table2' => 'nullable|string',
            'content' => 'nullable|string',
            'cta' => 'nullable|string',
            'link_program' => 'nullable|string',
            'id_yt' => 'nullable|string',
            'image4' => 'nullable|image|max:750',
            'brosur' => 'nullable|file|max:2048',
        ];

        $validated = $req->validate($rules);

        $program = Program::findOrFail($id);

        // Buat slug otomatis
        $validated['slug'] = Str::slug($validated['name']);

        // Encode array
        if ($req->has('facility_id')) {
            $validated['facility_id'] = json_encode($req->facility_id);
        }
        if ($req->has('supporting')) {
            $validated['supporting'] = json_encode($req->supporting);
        }

        // Upload gambar baru
        foreach (['image1', 'image2', 'image3', 'image4'] as $img) {
            if ($req->hasFile($img)) {
                if ($program->$img) {
                    Storage::disk('public')->delete($program->$img);
                }
                $validated[$img] = $req->file($img)->store('programs', 'public');
            }
        }

        // Upload brosur
        if ($req->hasFile('brosur')) {
            if ($program->brosur) {
                Storage::disk('public')->delete($program->brosur);
            }
            $validated['brosur'] = $req->file('brosur')->store('brosurs', 'public');
        }

        // Update data
        $program->update($validated);

        return redirect()->route('program.index')->with('success', 'Program berhasil diupdate!');
    }
}
