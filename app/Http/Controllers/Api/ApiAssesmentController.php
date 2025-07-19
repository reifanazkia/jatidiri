<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use Illuminate\Http\Request;

class ApiAssesmentController extends Controller
{
    public function index()
    {
        return response()->json(Assesment::latest()->get());
    }

    public function show($slug)
    {
        return response()->json(Assesment::where('slug', $slug)->firstOrFail());
    }
}
