<?php

namespace App\Http\Controllers;

use App\Models\Ganalytics;
use Illuminate\Http\Request;

class GanalyticsController extends Controller
{
    public function edit($id)
    {
        $data = Ganalytics::findOrFail($id);
        return view('ganalytics.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Ganalytics::findOrFail($id);

        $request->validate([
            'ganalytics' => 'nullable|string'
        ]);

        $data->ganalytics_code = $request->ganalytics_code;
        $data->save();

        return redirect()->route('ganalytics.edit', $id)->with('success', 'Data Berhasil Di Update');
    }
}
