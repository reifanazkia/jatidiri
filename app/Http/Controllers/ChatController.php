<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function edit($id)
    {
        $data = Chat::findOrFail($id);
        return view('chat.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Chat::findOrFail($id);

        $request->validate([
            'greating' => 'nullable|string'
        ]);

        $data->greating = $request->greating;
        $data->save();

        return redirect()->route('chat.edit', $id)->with('success', 'Data Berhasil Di Update');
    }
}
