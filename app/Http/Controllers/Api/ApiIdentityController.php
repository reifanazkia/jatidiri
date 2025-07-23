<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Identity;

class ApiIdentityController extends Controller
{
    public function index()
    {
        $data = Identity::first();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
