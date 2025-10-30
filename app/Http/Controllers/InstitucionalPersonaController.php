<?php

namespace App\Http\Controllers;

use App\Models\InstitucionalPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitucionalPersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($personas_id = null)
    {
        $personas = InstitucionalPersona::first();

        if (!$personas) {
            $personas = new InstitucionalPersona();
        }

        return view('content.admin.institucional-persona', [
            'persona' => $personas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);
        
        $personas = InstitucionalPersona::find($request->personas_id) ?? new InstitucionalPersona();
        $personas->nombre = $request->nombre;
        $personas->cargo = $request->cargo;
        $personas->texto1 = $request->texto1;
        $personas->texto2 = $request->texto2;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($personas->foto)) {
                $oldPath = str_replace('/storage/', '', $personas->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $personas->foto = Storage::url($path);
        }

        $personas->save();

        return redirect()->route('adm.institucional-persona', [
            'persona_id' => $personas->id
        ]);
    }
}