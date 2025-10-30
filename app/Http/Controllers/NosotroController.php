<?php

namespace App\Http\Controllers;

use App\Models\Nosotro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NosotroController extends Controller
{
    /**
     * Mostrar el recurso.
     */
    public function show($nosotros_id = null)
    {
        $nosotros = Nosotro::first() ?? new Nosotro();
        return view('content.admin.nosotros', ['nosotro' => $nosotros]);
    }

    /**
     * Actualizar o crear el recurso.
     */
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);
    
        $nosotros = Nosotro::find($request->nosotro_id) ?? new Nosotro();

        // Campos de texto
        $nosotros->texto_chico1   = $request->texto_chico1;
        $nosotros->texto_grande1  = $request->texto_grande1;
        $nosotros->descripcion    = $request->descripcion;
        $nosotros->texto_chico2   = $request->texto_chico2;
        $nosotros->texto_grande2  = $request->texto_grande2;
        $nosotros->nombre_icono1  = $request->nombre_icono1;
        $nosotros->texto_icono1   = $request->texto_icono1;
        $nosotros->nombre_icono2  = $request->nombre_icono2;
        $nosotros->texto_icono2   = $request->texto_icono2;
        $nosotros->nombre_icono3  = $request->nombre_icono3;
        $nosotros->texto_icono3   = $request->texto_icono3;

        // Subida de archivos (foto, video, iconos)
        $camposArchivos = [
            'foto'   => 'images',
            'video'  => 'videos',
            'icono1' => 'images',
            'icono2' => 'images',
            'icono3' => 'images',
        ];

        foreach ($camposArchivos as $campo => $carpeta) {
            if ($request->hasFile($campo)) {
                // Eliminar el archivo anterior si existe
                if (!empty($nosotros->$campo)) {
                    $oldPath = str_replace('/storage/', '', $nosotros->$campo);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                // Guardar el nuevo archivo
                $file = $request->file($campo);
                $name = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs($carpeta, $name, 'public');
                $nosotros->$campo = Storage::url($path);
            }
        }

        $nosotros->save();

        return redirect()->route('adm.nosotros', ['nosotro_id' => $nosotros->id])
            ->with('success', 'Sección nosotros actualizada correctamente.');
    }
}