@extends('layouts.app-login')

@section('title', 'Login | Hens Care')

@section('content')

<body class="flex items-center justify-center min-h-screen px-4">
    <div class="glass p-5 rounded-xl shadow-3xl w-full max-w-md text-white">
        <h2 class="text-2xl font-semibold text-center mb-6 flex items-center justify-center">
            <img src="{{ asset('images/hens.png') }}" alt="HensCare Icon" class="w-40 h-50">
            HensCare Login
        </h2>

        @if(session('error'))
        <div class="mb-4 text-red-400 text-sm text-center">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 text-sm">Email</label>
                <div class="flex items-center bg-white/20 border border-white/40 rounded">
                    <span class="px-3 text-white">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" required autofocus
                        class="w-full px-4 py-2 bg-transparent text-white placeholder-gray-300 focus:outline-none"
                        placeholder="peternak@ayam.com">
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm">Password</label>
                <div class="flex items-center bg-white/20 border border-white/40 rounded">
                    <span class="px-3 text-white">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 bg-transparent text-white placeholder-gray-300 focus:outline-none"
                        placeholder="********">
                </div>
            </div>

            <button type="submit" style="background-color: rgb(187, 187, 171);"
                onmouseover="this.style.backgroundColor='rgb(145, 137, 137)'"
                onmouseout="this.style.backgroundColor='rgb(187, 187, 171)'"
                class="w-full text-white py-2 rounded-md font-semibold shadow-md transition duration-300">
                Masuk
            </button>

            <div class="mt-4 text-center text-sm text-white/70">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-orange-300 hover:underline">Daftar</a>
            </div>
        </form>

    </div>
</body>
@endsection