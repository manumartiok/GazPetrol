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

    // Subida de la foto
    if ($request->hasFile('foto')) {
        // Eliminar foto anterior si existe
        if (!empty($usuario->foto)) {
            $oldPath = str_replace('/storage/', '', $usuario->foto);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Guardar la nueva foto
        $file = $request->file('foto');
        $name = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $name, 'public');
        $usuario->foto = Storage::url($path);
    }

    // Actualizar resto de campos
    $usuario->usuario = $request->usuario;
    $usuario->email = $request->email;

    if (!empty($request->contraseña)) {
        $usuario->contraseña = Hash::make($request->contraseña);
    }

    $usuario->save();

    return back()->with('success', 'Perfil actualizado correctamente.');
}

}