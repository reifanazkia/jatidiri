<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manfaat;
use Illuminate\Http\Request;

class ApiManfaatController extends Controller
{
     public function index()
    {
        $data = Manfaat::with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Manfaat Service',
            'data' => $data,
        ], 200);
    }

    public function show($slug)
    {
        $data = Manfaat::with('service')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Manfaat Service',
            'data' => $data,
        ], 200);
    }
}
