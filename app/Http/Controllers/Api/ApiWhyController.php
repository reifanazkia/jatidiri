<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Why;
use Illuminate\Http\Request;

class ApiWhyController extends Controller
{
    public function index(Request $request)
    {
        $query = Why::with('service');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get(),
        ]);
    }


    public function show($slug)
    {
        $why = Why::with('service')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $why,
        ]);
    }
}
