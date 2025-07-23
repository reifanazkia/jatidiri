<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ganalytics;

class ApiGanalyticsController extends Controller
{
    public function index()
    {
        $data = Ganalytics::first();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
