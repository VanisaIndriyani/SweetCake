<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            // Redirect sesuai role jika sudah login
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            // Redirect sesuai role jika sudah login
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email|unique:tb_users,email',
            'password' => 'required|min:6',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $verificationToken = Str::random(60);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => 'pelanggan',
            'status' => 'inactive', 
            'verification_token' => $verificationToken,
        ]);

        $verifyUrl = route('verify.email', ['token' => $verificationToken]);

        Mail::send('emails.verify', ['user' => $user, 'verifyUrl' => $verifyUrl], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Verifikasi Akun SweetCake Anda');
        });

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi akun.');
    }

    
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token verifikasi tidak valid.');
        }

        $user->update([
            'status' => 'active',
            'verification_token' => null, // hapus token agar tidak bisa dipakai ulang
        ]);

        return redirect()->route('login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Email tidak terdaftar.');
        }

        if ($user->status !== 'active') {
            return back()->withInput()->with('error', 'Akun belum aktif. Silakan cek email Anda untuk verifikasi.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->with('error', 'Password salah.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Redirect ke halaman yang diinginkan (intended) bila ada,
        // fallback sesuai role: admin -> /admin, user -> /dashboard
        $fallback = $user->role === 'admin' ? route('admin.dashboard') : route('dashboard');
        return redirect()->intended($fallback);
    }

   
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}
