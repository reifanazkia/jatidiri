<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{

    public function index(Request $request)
    {
        $query = Program::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10); // paginate 10 item per halaman

        return view('program.index', compact('data'));
    }
    
    // STEP 1: TAMPILKAN FORM
    public function create()
    {
        return view('program.create-step1');
    }

    // STEP 1: SIMPAN DATA
    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'facility_id' => 'required|integer',
            'title1' => 'required|string',
            'description1' => 'required|string',
            'image1' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'facility_id', 'title1', 'description1']);

        if ($request->hasFile('image1')) {
            $data['image1'] = $request->file('image1')->store('programs', 'public');
        }

        $data['slug'] = $this->generateUniqueSlug(Str::slug($data['name']));

        $program = Program::create($data);

        return redirect()->route('program.step2', $program->id);
    }

    // STEP 2: TAMPILKAN FORM
    public function step2($id)
    {
        $program = Program::findOrFail($id);
        return view('program.create-step2', compact('program'));
    }

    // STEP 2: UPDATE
    public function updateStep2(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'ourteam_id' => 'required|integer',
            'id_yt' => 'nullable|string',
            'title2' => 'required|string',
            'dukungan_id' => 'required|integer',
            'description2' => 'required|string',
            'image2' => 'nullable|image|max:2048',
            'title3' => 'required|string',
            'description3' => 'required|string',
            'image3' => 'nullable|image|max:2048',
        ]);

        if ($request->has('remove_image2') || $request->hasFile('image2')) {
            if ($program->image2 && Storage::disk('public')->exists($program->image2)) {
                Storage::disk('public')->delete($program->image2);
            }
            $program->image2 = null;
        }
        if ($request->hasFile('image2')) {
            $program->image2 = $request->file('image2')->store('programs', 'public');
        }

        if ($request->has('remove_image3') || $request->hasFile('image3')) {
            if ($program->image3 && Storage::disk('public')->exists($program->image3)) {
                Storage::disk('public')->delete($program->image3);
            }
            $program->image3 = null;
        }
        if ($request->hasFile('image3')) {
            $program->image3 = $request->file('image3')->store('programs', 'public');
        }

        $program->update($request->only([
            'ourteam_id', 'id_yt', 'title2', 'dukungan_id',
            'description2', 'title3', 'description3'
        ]));

        return redirect()->route('program.step3', $program->id);
    }

    // STEP 3: TAMPILKAN FORM
    public function step3($id)
    {
        $program = Program::findOrFail($id);
        return view('program.create-step3', compact('program'));
    }

    // STEP 3: UPDATE
    public function updateStep3(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'title4' => 'required|string',
            'description4' => 'required|string',
            'image4' => 'nullable|image|max:2048',
            'content' => 'required|string',
            'cta' => 'nullable|string',
            'link_program' => 'nullable|url',
            'brosur' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->has('remove_image4') || $request->hasFile('image4')) {
            if ($program->image4 && Storage::disk('public')->exists($program->image4)) {
                Storage::disk('public')->delete($program->image4);
            }
            $program->image4 = null;
        }
        if ($request->hasFile('image4')) {
            $program->image4 = $request->file('image4')->store('programs', 'public');
        }

        if ($request->has('remove_brosur') || $request->hasFile('brosur')) {
            if ($program->brosur && Storage::disk('public')->exists($program->brosur)) {
                Storage::disk('public')->delete($program->brosur);
            }
            $program->brosur = null;
        }
        if ($request->hasFile('brosur')) {
            $program->brosur = $request->file('brosur')->store('programs/brosur', 'public');
        }

        $program->update($request->only([
            'title4', 'description4', 'content', 'cta', 'link_program'
        ]));

        return redirect()->route('program.index')->with('success', 'Program berhasil disimpan.');
    }

    // SLUG UNIK
    protected function generateUniqueSlug($slug)
    {
        $uniqueSlug = $slug;
        $i = 1;
        while (Program::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }
        return $uniqueSlug;
    }

    // CKEDITOR UPLOAD
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/programs', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path),
            ]);
        }
    }

    // BULK DELETE
    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        $programs = Program::whereIn('id', $request->ids)->get();

        foreach ($programs as $program) {
            foreach (['image1', 'image2', 'image3', 'image4', 'brosur'] as $field) {
                if ($program->$field && Storage::disk('public')->exists($program->$field)) {
                    Storage::disk('public')->delete($program->$field);
                }
            }
            $program->delete();
        }

        return response()->json(['message' => 'Program berhasil dihapus.']);
    }
}
