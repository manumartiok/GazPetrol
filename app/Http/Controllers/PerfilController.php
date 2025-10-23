<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;

class PerfilController extends Controller
{
    public function show()
    {
        $usuario = Auth::user();
        return view('content.admin.perfil', compact('usuario'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Usuario $usuario */
        $usuario = Auth::user();

        $request->validate([
            'usuario' => 'required|string|max:255',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'contraseña' => 'nullable|min:6|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            // Borrar foto anterior si existe
            if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
                Storage::disk('public')->delete($usuario->foto);
            }

            $path = $request->file('foto')->store('images', 'public');
            $usuario->foto = Storage::url($path);
        }

        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;

        if (!empty($request->contraseña)) {
            $usuario->contraseña = Hash::make($request->contraseña);
        }

        $usuario->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
    
}