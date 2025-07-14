<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unggulan;
use Illuminate\Http\Request;

class ApiUnggulanController extends Controller
{
    // GET /api/unggulans
    public function index(Request $request)
    {
        $query = Unggulan::with('program');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get(),
        ]);
    }

    // GET /api/unggulans/{slug}
    public function show($slug)
    {
        $unggulan = Unggulan::with('program')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $unggulan,
        ]);
    }
}

