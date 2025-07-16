<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Legal;

class ApiLegalController extends Controller
{
    // Ambil semua legal certificates
    public function index()
    {
        $legals = Legal::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $legals
        ]);
    }

    // Ambil satu legal certificate berdasarkan ID
    public function show($id)
    {
        $legal = Legal::find($id);

        if (!$legal) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $legal
        ]);
    }
}
