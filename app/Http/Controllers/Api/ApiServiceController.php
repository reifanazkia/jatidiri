<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ApiServiceController extends Controller
{
     public function index()
    {
        return response()->json([
            'data' => Service::latest()->get(),
        ]);
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return response()->json([
            'data' => $service,
        ]);
    }
}
