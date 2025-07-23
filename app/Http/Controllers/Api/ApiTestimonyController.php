<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimony;

class ApiTestimonyController extends Controller
{
    // GET /api/testimonies
    public function index()
    {
        $data = Testimony::with('program')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // GET /api/testimonies/{slug}
    public function show($slug)
    {
        $testimony = Testimony::with('program')->where('slug', $slug)->first();

        if (!$testimony) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $testimony
        ]);
    }
}
