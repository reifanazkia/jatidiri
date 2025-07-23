<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alasan;
use Illuminate\Http\Request;

class ApiAlasanController extends Controller
{
    // GET /api/alasan-services
    public function index()
    {
        $data = Alasan::with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Alasan Service',
            'data' => $data,
        ], 200);
    }

    // GET /api/alasan-services/{slug}
    public function show($slug)
    {
        $data = Alasan::with('service')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Alasan Service',
            'data' => $data,
        ], 200);
    }
}
