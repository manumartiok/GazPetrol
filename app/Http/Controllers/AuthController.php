<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin(Request $request)
    {
        // Si venimos de un logout exitoso, podemos mostrar un mensaje
        $logoutMessage = session('logout_message');
        return view('auth.login', compact('logoutMessage'));
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'contraseña' => 'required',
        ]);

        $usuario = Usuario::where('usuario', $request->usuario)
                          ->orWhere('email', $request->usuario)
                          ->first();

        if (!$usuario) {
            return back()->withErrors([
                'usuario' => 'Usuario o email incorrecto',
            ]);
        }

        if (!Hash::check($request->contraseña, $usuario->contraseña)) {
            return back()->withErrors([
                'usuario' => 'Contraseña incorrecta',
            ]);
        }

        if (!$usuario->active) {
            return back()->withErrors([
                'usuario' => 'Tu cuenta está inactiva. Contacta al administrador.',
            ]);
        }

        // Login exitoso
        Auth::login($usuario);
        return redirect()->route('adm.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al login con mensaje
        return redirect('/admin/login')->with('logout_message', 'Has cerrado sesión correctamente.');
    }

    // Forgot password
    public function forgotPassword(Request $request)
    {
        // Validación básica
        $request->validate([
            'email' => 'required|email|exists:usuarios,email', // ajustado a tu tabla
        ]);

        // Enviar link de reseteo
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        } else {
            return back()->with('error', __($status));
        }
    }
}