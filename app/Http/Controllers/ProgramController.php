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

    public function create() // step1 form
    {
        $outreams = Ourteam::all();
        $facilities = Assesment::all();
        return view('program.create', compact('outreams','facilities'));
    }

    public function store(Request $req)
    {
        $hasNewImage1 = $req->hasFile('image1');
        $hasPreview1 = !empty($req->input('image1_preview'));
        $img1Required = !$hasNewImage1 && !$hasPreview1;

        $rules = [
            'name' => 'required|string',
            'category' => 'nullable|string',
            'slug' => 'nullable|string',
            'outream_id' => 'nullable|exists:outreams,id',
            'facility_id' => 'nullable|exists:facilities,id',
            'title1'=>'nullable|string','description1'=>'nullable|string',
            'image1_preview'=>'nullable|string'
        ];

        $rules['slug'] = 'nullable|string';
        $rules['image1'] = $img1Required
            ? 'required|image|max:750'
            : 'nullable|image|max:750';

        $validated = $req->validate($rules);
        $validated['slug'] = Str::slug($validated['name']);
        unset($validated['image1_preview']);

        if ($req->hasFile('image1')) {
            $validated['image1'] = $req->file('image1')->store('programs','public');
        }

        $program = Program::create($validated);
        return redirect()->route('program.step2',$program->id)
            ->with('success','Langkah 1 selesai')->with('program_id',$program->id);
    }

    public function step2(string $id)
    {
        $program = Program::findOrFail($id);
        return view('program.step2', compact('program'));
    }

    public function step2Update(Request $req, string $id)
    {
        $p = Program::findOrFail($id);

        $hasNew2 = $req->hasFile('image2');
        $hasPrev2 = !empty($req->input('image2_preview'));
        $rem2 = $req->input('remove_image2')==='1';
        $req2 = ((!$p->image2 && !$hasNew2 && !$hasPrev2) || ($rem2 && !$hasNew2 && !$hasPrev2));

        $hasNew3 = $req->hasFile('image3');
        $hasPrev3 = !empty($req->input('image3_preview'));
        $rem3 = $req->input('remove_image3')==='1';
        $req3 = ((!$p->image3 && !$hasNew3 && !$hasPrev3) || ($rem3 && !$hasNew3 && !$hasPrev3));

        $rules = [
            'title2'=>'required|string','description2'=>'required|string',
            'title3'=>'required|string','description3'=>'required|string',
            'image2_preview'=>'nullable|string','image3_preview'=>'nullable|string',
            'remove_image2'=>'nullable|string','remove_image3'=>'nullable|string',
        ];
        $rules['image2'] = $req2 ? 'required|image|max:750' : 'nullable|image|max:750';
        $rules['image3'] = $req3 ? 'required|image|max:750' : 'nullable|image|max:750';

        $validated = $req->validate($rules);
        unset($validated['image2_preview'],$validated['image3_preview']);

        // fungsi bantu hapus/upload image2
        if ($rem2) {
            if ($p->image2) Storage::disk('public')->delete($p->image2);
            $validated['image2'] = $hasNew2 ? $req->file('image2')->store('programs','public') : null;
        } elseif ($hasNew2) {
            if ($p->image2) Storage::disk('public')->delete($p->image2);
            $validated['image2'] = $req->file('image2')->store('programs','public');
        } else unset($validated['image2']);

        // image3
        if ($rem3) {
            if ($p->image3) Storage::disk('public')->delete($p->image3);
            $validated['image3'] = $hasNew3 ? $req->file('image3')->store('programs','public') : null;
        } elseif ($hasNew3) {
            if ($p->image3) Storage::disk('public')->delete($p->image3);
            $validated['image3'] = $req->file('image3')->store('programs','public');
        } else unset($validated['image3']);

        $p->update($validated);
        return redirect()->route('program.step3',$p->id)->with('success','Langkah 2 selesai');
    }

    public function step3(string $id)
    {
        $program = Program::findOrFail($id);
        return view('program.step3', compact('program'));
    }

    public function step3Update(Request $req, string $id)
    {
        $p = Program::findOrFail($id);

        $hasNew4 = $req->hasFile('image4');
        $hasPrev4 = !empty($req->input('image4_preview'));
        $rem4 = $req->input('remove_image4')==='1';
        $req4 = ((!$p->image4 && !$hasNew4 && !$hasPrev4) || ($rem4 && !$hasNew4));

        $hasNewBro = $req->hasFile('brosur');

        $rules = [
            'title4'=>'required|string','description4'=>'required|string',
            'age'=>'required|string','weekly'=>'required|string','periode'=>'required|string',
            'class_size'=>'required|string','time_table2'=>'nullable|string',
            'content'=>'nullable|string','cta'=>'nullable|string',
            'link_program'=>'nullable|string','id_yt'=>'nullable|string',
            'remove_image4'=>'nullable|string','image4_preview'=>'nullable|string'
        ];
        $rules['image4'] = $req4 ? 'required|image|max:750' : 'nullable|image|max:750';
        $rules['brosur'] = $hasNewBro ? 'nullable|file|max:2048' : 'nullable|file|max:2048';

        $validated = $req->validate($rules);
        unset($validated['image4_preview']);

        if ($rem4) {
            if ($p->image4) Storage::disk('public')->delete($p->image4);
            $validated['image4'] = $hasNew4 ? $req->file('image4')->store('programs','public') : null;
        } elseif ($hasNew4) {
            if ($p->image4) Storage::disk('public')->delete($p->image4);
            $validated['image4'] = $req->file('image4')->store('programs','public');
        } else unset($validated['image4']);

        if ($hasNewBro) {
            if ($p->brosur) Storage::disk('public')->delete($p->brosur);
            $validated['brosur'] = $req->file('brosur')->store('brosurs','public');
        }

        $p->update($validated);
        return redirect()->route('program.index')->with('success','Program berhasil dibuat!');
    }

    public function destroy(string $id)
    {
        $p = Program::findOrFail($id);
        foreach (['image1','image2','image3','image4','brosur'] as $field) {
            if ($p->$field) Storage::disk('public')->delete($p->$field);
        }
        $p->delete();
        return redirect()->route('program.index')->with('success','Program dihapus lengkap dengan file.');
    }
}
