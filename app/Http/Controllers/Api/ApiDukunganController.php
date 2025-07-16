<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dukungan;

class ApiDukunganController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Dukungan::latest()->get(),
        ]);
    }

    public function show($slug)
    {
        $dukungan = Dukungan::where('slug', $slug)->firstOrFail();
        return response()->json([
            'data' => $dukungan,
        ]);
    }
}
