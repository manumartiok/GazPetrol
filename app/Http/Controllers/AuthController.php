<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
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

        if ($usuario && Hash::check($request->contraseña, $usuario->contraseña) && $usuario->active) {
            Auth::login($usuario);
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'usuario' => 'Usuario o contraseña incorrecta o cuenta inactiva',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}