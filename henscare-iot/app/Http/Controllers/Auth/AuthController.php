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

        $response = Http::post('http://auth-service:8085/api/auth/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'confirmPassword' => $request->password_confirmation,
        ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
        }

        return back()->withErrors(['register_error' => $response->body()])->withInput();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post('http://auth-service:8085/api/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $token = $response->body();
            if (substr_count($token, '.') === 2) {
                session(['jwt_token' => $token]);
                return redirect()->route('dashboard');
            }

            return back()->withErrors(['login_error' => 'Login gagal. Token tidak valid.']);
        }

        return back()->withErrors(['login_error' => 'Email atau password salah']);
    }

    public function dashboard()
    {
        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login dulu.']);
        }

        $response = Http::withToken($token)->get('http://auth-service:8085/api/auth/protected-endpoint');

        if ($response->successful()) {
            $data = $response->body();
            return view('dashboard', ['data' => $data]);
        }

        return redirect()->route('login')->withErrors(['auth' => 'Token tidak valid atau kadaluarsa.']);
    }

    public function logout()
    {
        session()->forget('jwt_token');
        return redirect()->route('login');
    }
}