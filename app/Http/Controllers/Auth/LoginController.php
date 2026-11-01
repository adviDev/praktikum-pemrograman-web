<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    //
    public function showLoginForm(): View
    {
        return view("auth.login");
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email"=> ["required","email"],
            "password"=> ["required","string"],
        ],[
            "email.required"=> "Email wajib diisi",
            "email.email"=> "Format email tidak valid",
            "password.required"=> "kata sandi wajib diisi"
        ]);

        $key = $this->throttleKey($request);

        if(RateLimiter::tooManyAttempts($key, 5)){
            $detik = RateLimiter::availableIn($key);
            $pesan = "terlalu banyak percobaan login. coba lagi dalam ($detik) detik.";

            return back()->with("error", $pesan)->onlyInput('email');
        }

        if(Auth::attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();
            $pesan = "login berhasil. selamat datan, ". Auth::user()->name .".";
            return redirect()->intended(route('dashboard'))->with('success', $pesan);
        }

        RateLimiter::hit($key,60);

        return back()
            ->with('error','email atau kata sandi tidak sesuai')
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success','anda telah berhasi keluar');
    }
    private function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower((string) $request->input('email')). '|'. $request->ip()
        );
    }
}
