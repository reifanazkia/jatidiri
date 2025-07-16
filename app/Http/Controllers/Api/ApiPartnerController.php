<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;

class ApiPartnerController extends Controller
{
    // Ambil semua data partner
    public function index()
    {
        $partners = Partner::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $partners
        ]);
    }

    // Ambil detail partner berdasarkan slug
    public function show($slug)
    {
        $partner = Partner::where('slug', $slug)->first();

        if (!$partner) {
            return response()->json([
                'status' => 'error',
                'message' => 'Partner not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $partner
        ]);
    }
}
