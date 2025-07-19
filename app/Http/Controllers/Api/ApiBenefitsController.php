<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Benefits;

class ApiBenefitsController extends Controller
{
    public function index()
    {
        return response()->json(Benefits::with('facility')->latest()->get());
    }

    public function show($slug)
    {
        return response()->json(Benefits::with('facility')->where('slug', $slug)->firstOrFail());
    }
}

