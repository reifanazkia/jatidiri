<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\How;
use Illuminate\Http\Request;

class ApiHowController extends Controller
{
    
    public function index()
    {
        $data = How::with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar How Service',
            'data' => $data,
        ], 200);
    }

    public function show($slug)
    {
        $data = How::with('service')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail How Service',
            'data' => $data,
        ], 200);
    }
}
