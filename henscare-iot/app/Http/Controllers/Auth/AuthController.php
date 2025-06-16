<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.registration');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $response = Http::post('http://192.168.1.16:8085/api/auth/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'confirmPassword' => $request->password_confirmation,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
        }

        return back()->withErrors([
            'register_error' => $response->json('message') ?? 'Registrasi gagal. Silakan coba lagi.',
        ])->withInput();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post('http://192.168.1.16:8085/api/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $token = $response->body();

            // Validasi format JWT
            if (substr_count($token, '.') === 2) {
                session(['jwt_token' => $token]);
                return redirect()->route('dashboard');
            }

            return back()->withErrors(['login_error' => 'Login gagal. Token tidak valid.']);
        }

        return back()->withErrors(['login_error' => 'Email atau password salah.']);
    }

    public function dashboard()
    {
        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
        }

        // Panggil endpoint validasi atau data protected di auth-service
        $response = Http::withToken($token)->get('http://192.168.1.16:8085/api/auth/validate');

        if ($response->successful()) {
            $userEmail = $response->body(); // Misal: email pengguna

            return view('dashboard', ['email' => $userEmail]);
        }

        session()->forget('jwt_token');
        return redirect()->route('login')->withErrors(['auth' => 'Session kadaluarsa atau token tidak valid. Silakan login kembali.']);
    }

    public function logout()
    {
        session()->forget('jwt_token');
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}