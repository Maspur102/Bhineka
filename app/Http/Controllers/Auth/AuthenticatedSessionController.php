<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // <-- TAMBAHKAN BARIS INI
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller // <-- Sekarang Controller ini dikenali
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Menggunakan RouteServiceProvider::HOME atau route('admin.dashboard') (Jika sudah diperbaiki)
        return redirect()->intended(RouteServiceProvider::HOME); 
        // Jika Anda menggunakan Opsi A sebelumnya, ganti baris di atas menjadi:
        // return redirect()->intended(route('admin.dashboard')); 
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}