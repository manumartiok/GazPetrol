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
       public function show($personas_id=null)

    {
        
        $personas=InstitucionalPersona::first();
        
        if(!$personas){
            $personas=new InstitucionalPersona();
        }
        return view('content.admin.institucional-persona', ['persona'=>$personas]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $personas= InstitucionalPersona::find($request->personas_id);
        
        if(!$personas){
            $personas=new InstitucionalPersona();
        }

            $personas->nombre=$request->nombre;
            $personas->cargo=$request->cargo;
            $personas->texto1=$request->texto1;
            $personas->texto2=$request->texto2;

              // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($personas->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $personas->foto);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('foto');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $personas->foto = Storage::url($filePath);
    }

        $personas->save();

        return redirect()->route('adm.institucional-persona', ['persona_id' => $personas->id]);
    }
}
