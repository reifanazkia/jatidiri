<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ApiChatController extends Controller
{
    public function index()
    {
        $data = Chat::first();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}

