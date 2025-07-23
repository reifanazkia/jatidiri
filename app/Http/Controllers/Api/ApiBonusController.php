<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use Illuminate\Http\Request;

class ApiBonusController extends Controller
{

    public function index()
    {
        $data = Bonus::with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Bonus Service',
            'data' => $data,
        ], 200);
    }

    public function show($slug)
    {
        $data = Bonus::with('service')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Bonus Service',
            'data' => $data,
        ], 200);
    }
}
