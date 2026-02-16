<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success','Cadastro realizado!');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))) {
            return redirect('/dashboard');
        }

        return back()->with('error','Login inválido');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // ===============================
    // ESQUECI SENHA - ENVIA LINK
    // ===============================

    public function showForgot()
    {
        return view('forgot');
    }

    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with('success', 'Link enviado para seu email!')
                : back()->withErrors(['email' => __($status)]);
    }

    // ===============================
    // RESET SENHA
    // ===============================

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect('/login')->with('success', 'Senha redefinida!')
                : back()->withErrors(['email' => [__($status)]]);
    }
}
