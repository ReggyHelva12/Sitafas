<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login ADMIN
     */
    public function showLogin()
    {
        return view('pages.auth.login');
    }


    /**
     * Proses login ADMIN
     */
    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 50 karakter.',
            'password.required' => 'Password wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CREDENTIALS ADMIN
        |--------------------------------------------------------------------------
        |
        | Role sengaja dibuat otomatis ADMIN.
        | User tidak perlu memilih role lagi.
        |
        */

        $credentials = [
            'username' => trim($request->username),
            'password' => $request->password,
            'role'     => 'admin',
            'status'   => 'aktif',
        ];


        /*
        |--------------------------------------------------------------------------
        | PROSES AUTHENTICATION
        |--------------------------------------------------------------------------
        */

        if (Auth::attempt($credentials)) {

            /*
            |--------------------------------------------------------------------------
            | REGENERATE SESSION
            |--------------------------------------------------------------------------
            */

            $request->session()->regenerate();

            $user = Auth::user();


            /*
            |--------------------------------------------------------------------------
            | PASTIKAN BENAR-BENAR ADMIN
            |--------------------------------------------------------------------------
            */

            if ($user->role !== 'admin') {

                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors([
                        'username' => 'Akun ini tidak memiliki akses sebagai administrator.',
                    ])
                    ->withInput(
                        $request->only('username')
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | REDIRECT ADMIN
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'success',
                    'Selamat datang, ' . $user->nama . '!'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN GAGAL
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput(
                $request->only('username')
            )
            ->withErrors([
                'username' => 'Username atau password admin tidak sesuai.',
            ]);
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | LOGOUT
        |--------------------------------------------------------------------------
        */

        Auth::logout();


        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil keluar dari sistem.'
            );
    }
}