<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;

class ApiPricingController extends Controller
{
     public function index(Request $request)
    {
        $query = Pricing::with('program');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get(),
        ]);
    }

    
    public function show($slug)
    {
        $program = Pricing::with('program')->where('slug', $slug)->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $program,
        ]);
    }
}
