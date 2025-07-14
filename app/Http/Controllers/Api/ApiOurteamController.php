<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ourteam;
use Illuminate\Http\Request;

class ApiOurteamController extends Controller
{
    // Ambil semua data ourteam
    public function index()
    {
        $data = Ourteam::with('category')->latest()->get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Ambil detail ourteam by ID
    public function show($id)
    {
        $team = Ourteam::with('category')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $team
        ]);
    }
}

