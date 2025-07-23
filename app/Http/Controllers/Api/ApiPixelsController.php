<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pixels;

class ApiPixelsController extends Controller
{
    public function index()
    {
        $data = Pixels::first();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
