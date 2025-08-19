<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{


    // Tambah user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.edit')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan halaman edit profil & daftar user
    public function edit()
    {
        $user = Auth::user(); // user yang sedang login
        $users = User::latest()->get(); // semua user untuk tabel

        return view('user.edit_user', compact('user', 'users'));
    }

    // Update nama, email, dan foto profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }

            $validated['photo'] = $request->file('photo')->store('profile_photos');
        }

        $user->update($validated);

        return redirect()->route('user.edit', $user->id)->with('success', 'Profil berhasil diperbarui.');

    }

    // Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.edit_user')->with('success', 'Password berhasil diubah.');
    }

    // Hapus user lain (bukan diri sendiri)
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        if ($user->photo && Storage::exists($user->photo)) {
            Storage::delete($user->photo);
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    // Edit user lain (admin atau pengelola)
    public function editUser($id)
    {
        $user = Auth::user();              // user yang login (optional, kalau perlu di view)
        $users = User::latest()->get();    // semua user
        $editUser = User::findOrFail($id); // user yang akan diedit

        return view('user.edit_user', compact('user', 'users', 'editUser'));
    }
}
