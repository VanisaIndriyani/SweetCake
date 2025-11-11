<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|min:3',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'password' => 'nullable|min:6',
        ]);

        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $user->password = \Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil diperbarui.');
    }
}