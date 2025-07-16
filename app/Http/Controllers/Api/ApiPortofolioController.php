<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;

class ApiPortofolioController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Portofolio::with('program')->latest()->get()
        ]);
    }

    public function show($slug)
    {
        $portfolio = Portofolio::with('program')->where('slug', $slug)->firstOrFail();
        return response()->json([
            'data' => $portfolio
        ]);
    }
}

