<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class ApiSliderController extends Controller
{
    public function index(Request $request)
    {
        $query = Slider::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $sliders = $query->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $sliders,
        ]);
    }
}
