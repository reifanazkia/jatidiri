<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ApiProgramController extends Controller
{
    // GET /api/programs
    public function index(Request $request)
    {
        $query = Program::with('yutub');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get(),
        ]);
    }

    // GET /api/programs/{slug}
    public function show($slug)
    {
        $program = Program::with('yutub')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $program,
        ]);
    }
}

