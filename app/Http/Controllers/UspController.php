<?php

namespace App\Http\Controllers;

use App\Models\Usp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UspController extends Controller
{
    public function index(Request $request)
    {
        $query = Usp::query();

        if ($search = $request->get('search')) {
            $query->where('Title', 'like', "%{$search}%");
        }

        $usps = $query->latest()->get();

        return view('usp.index', compact('usps'));
    }

    public function create()
    {
        return view('usp.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Description' => 'nullable|string|max:255',
        ]);

        try {
            $dataToStore = [
                'Title' => $validated['Title'],
                'Description' => $validated['Description'] ?? null,
            ];

            if ($request->hasFile('Image')) {
                $dataToStore['Image'] = $request->file('Image')->store('usps', 'public');
            }

            Usp::create($dataToStore);

            return redirect()->route('usp.index')
                ->with('success', 'USP berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan USP: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $usp = Usp::findOrFail($id);
        return view('usp.edit', compact('usp'));
    }

    public function update(Request $request, $id)
    {
        try {
            $usp = Usp::findOrFail($id);

            $validated = $request->validate([
                'Title' => 'required|string|max:255',
                'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Description' => 'nullable|string|max:255',
            ]);

            $dataToUpdate = [
                'Title' => $validated['Title'],
                'Description' => $validated['Description'] ?? null,
            ];

            if ($request->hasFile('Image')) {
                // Delete old image if exists
                if ($usp->Image && Storage::disk('public')->exists($usp->Image)) {
                    Storage::disk('public')->delete($usp->Image);
                }
                $dataToUpdate['Image'] = $request->file('Image')->store('usps', 'public');
            }

            $usp->update($dataToUpdate);

            return redirect()->route('usp.index')
                ->with('update_success', 'USP berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui USP: ' . $e->getMessage());
        }
    }

    // Di method destroy:
    public function destroy($id)
    {
        try {
            $usp = Usp::findOrFail($id);

            if ($usp->Image && Storage::disk('public')->exists($usp->Image)) {
                Storage::disk('public')->delete($usp->Image);
            }

            $usp->delete();

            return redirect()->route('usp.index')
                ->with('delete_success', 'USP berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('usp.index')
                ->with('error', 'Gagal menghapus USP: ' . $e->getMessage());
        }
    }
}
