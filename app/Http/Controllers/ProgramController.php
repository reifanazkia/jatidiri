<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::with('yutub');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $programs = $query->latest()->get();
        return view('admin.program.index', compact('programs'));
    }

    public function step2($id)
    {
        $program = Program::findOrFail($id);
        return view('program.step2', compact('program'));

    }

    public function step3($id)
    {
        $program = Program::findOrFail($id);
        return view('program.step3', compact('program'));

    }

    public function show($slug)
    {
        $program = Program::with('yutub')->where('slug', $slug)->firstOrFail();
        return view('admin.program.show', compact('program'));
    }

     public function store(Request $request)
    {
        // Cek apakah ada gambar baru atau ada preview yang tersimpan
        $hasNewImage = $request->hasFile('image1');
        $hasPreviewImage = !empty($request->input('image1_preview')); // Tambahkan hidden field untuk preview

        // Gambar required hanya jika tidak ada file baru dan tidak ada preview
        $imageRequired = !$hasNewImage && !$hasPreviewImage;

        $rules = [
            'name'   => 'required|string',
            'slug'   => 'required|string',
            'title1'   => 'required|string',
            'description1'   => 'required|string',
            'id_yt' => 'nullable|exists:yutubs,id',
            'ourteam_id'   => 'nullable|exists:ourteam,id',
        ];

        // Set rule untuk image1
        if ($imageRequired) {
            $rules['image1'] = 'required|mimes:jpg,jpeg,png,pdf,webp|max:2048';
        } else {
            $rules['image1'] = 'nullable|mimes:jpg,jpeg,png,pdf,webp|max:2048';
        }

        $validate = $request->validate($rules);

        // Buat slug otomatis
        $validate['slug'] = Str::slug($validate['name']);

        if ($request->hasFile('image1')) {
            $validate['image1'] = $request->file('image1')->store('departement-image', 'public');
        }

        // Tambahkan default jika tidak diisi
        $validate['status'] = $request->input('status', 'active');

        // Hapus field yang tidak perlu disimpan
        unset($validate['image1_preview']);

        $program = Program::create($validate); // Simpan instance-nya

        return redirect()->route('departement.step2', $program->id)->with('success', "Program {$program->name} berhasil dibuat!");
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'title1' => 'nullable|string',
            'description1' => 'nullable|string',
            'image1' => 'nullable|string',
            'title2' => 'nullable|string',
            'description2' => 'nullable|string',
            'image2' => 'nullable|string',
            'title3' => 'nullable|string',
            'description3' => 'nullable|string',
            'image3' => 'nullable|string',
            'title4' => 'nullable|string',
            'description4' => 'nullable|string',
            'image4' => 'nullable|string',
            'age' => 'nullable|string',
            'weekly' => 'nullable|string',
            'periode' => 'nullable|string',
            'ourteam_id' => 'nullable|integer',
            'class_size' => 'nullable|string',
            'time_table' => 'nullable|string',
            'time_table2' => 'nullable|string',
            'content' => 'nullable|string',
            'cta' => 'nullable|string',
            'link_program' => 'nullable|url',
            'id_yt' => 'nullable|exists:yutubs,id',
            'brosur' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);
        $i = 1;
        $uniqueSlug = $slug;
        while (Program::where('slug', $uniqueSlug)->where('id', '!=', $id)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        $data['slug'] = $uniqueSlug;

        $program->update($data);
        return back()->with('success', 'Program berhasil diperbarui');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        if ($program->brosur && File::exists(public_path('storage/' . $program->brosur))) {
            File::delete(public_path('storage/' . $program->brosur));
        }

        $program->delete();
        return back()->with('success', 'Program berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        $programs = Program::whereIn('id', $request->ids)->get();

        foreach ($programs as $program) {
            if ($program->brosur && File::exists(public_path('storage/' . $program->brosur))) {
                File::delete(public_path('storage/' . $program->brosur));
            }
            $program->delete();
        }

        return response()->json(['message' => 'Program berhasil dihapus secara massal.']);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/programs', $filename, 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
    }

    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Program::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }
}
