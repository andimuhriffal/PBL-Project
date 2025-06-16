<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyJwtToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login terlebih dahulu.']);
        }

        $response = Http::withToken($token)->get('http://auth-service:8085/api/auth/validate');

        if ($response->status() !== 200) {
            session()->forget('jwt_token'); // hapus token kadaluarsa
            return redirect()->route('login')->withErrors(['auth' => 'Sesi telah berakhir. Silakan login kembali.']);
        }

        return $next($request);
    }
}