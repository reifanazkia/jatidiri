<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;

class ApiAgendaController extends Controller
{
    /**
     * Tampilkan semua agenda (desc by created_at).
     */
    public function index()
    {
        $agendas = Agenda::latest()->get();
        return response()->json($agendas);
    }

    /**
     * Tampilkan detail agenda berdasarkan slug.
     */
    public function show($slug)
    {
        $agenda = Agenda::where('slug', $slug)->first();

        if (!$agenda) {
            return response()->json([
                'message' => 'Agenda not found'
            ], 404);
        }

        return response()->json($agenda);
    }
}
