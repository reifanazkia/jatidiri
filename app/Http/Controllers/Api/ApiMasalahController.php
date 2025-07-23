<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Masalah;
use Illuminate\Http\Request;

class ApiMasalahController extends Controller
{

    public function index()
    {
        $data = Masalah::with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Masalah Service',
            'data' => $data,
        ], 200);
    }

    public function show($slug)
    {
        $data = Masalah::with('service')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Masalah Service',
            'data' => $data,
        ], 200);
    }
}
