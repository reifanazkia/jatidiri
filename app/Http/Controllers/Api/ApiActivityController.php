<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ApiActivityController extends Controller
{
    public function index()
    {
        $data = Activity::with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'messege' => 'Daftar Activity Service',
            'data' => $data
        ], 200);
    }

    public function show($slug)
    {
        $data = Activity::with('service')->where('slug', $slug)->first();

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Activity Service',
            'data' => $data,
        ], 200);
    }
}
