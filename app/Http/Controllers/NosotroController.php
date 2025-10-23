<?php

namespace App\Http\Controllers;

use App\Models\Nosotro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NosotroController extends Controller
{
    /**

     * Display the specified resource.
     */
    public function show($nosotros_id=null)
    {
        $nosotros=Nosotro::first();

                
        if(!$nosotros){
            $nosotros=new Nosotro();
        }
        return view('content.admin.nosotros', ['nosotro'=>$nosotros]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request)
    {
        $nosotros= Nosotro::find($request->nosotro_id);
        
        if(!$nosotros){
            $nosotros=new Nosotro();
        }

            $nosotros->texto_chico1=$request->texto_chico1;
            $nosotros->texto_grande1=$request->texto_grande;
            $nosotros->descripcion=$request->descripcion;
            $nosotros->texto_chico2=$request->texto_chico2;
            $nosotros->texto_grande2=$request->texto_grande2;
            $nosotros->nombre_icono1=$request->nombre_icono1;
            $nosotros->texto_icono1=$request->texto_icono1;
            $nosotros->nombre_icono2=$request->nombre_icono2;   
            $nosotros->texto_icono2=$request->texto_icono2;
            $nosotros->nombre_icono3=$request->nombre_icono3;
            $nosotros->texto_icono3=$request->texto_icono3;


        // Verificar si se subió un nuevo video
        if ($request->hasFile('video')) {

            // 🧹 Borrar el video anterior (si existe)
            if (!empty($nosotros->video)) {
                // Convertir la URL tipo "/storage/videos/xxx.mp4" a ruta real
                $oldPath = str_replace('/storage/', 'public/', $nosotros->video);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }

            // 📹 Guardar el nuevo video
            $file = $request->file('video');
            $name = time() . '.' . $file->getClientOriginalName();
            $filePath = 'public/videos/' . $name;  // Carpeta diferente para videos
            Storage::put($filePath, file_get_contents($file));

            // Guardar la URL accesible públicamente en la base
            $nosotros->video = Storage::url($filePath);
        }

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($nosotros->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $nosotros->foto);
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
        $nosotros->foto = Storage::url($filePath);
    }


     // Verificar si se subió una nueva imagen
         if ($request->hasFile('icono1')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($nosotros->icono1)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $nosotros->icono1);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('icono1');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $nosotros->icono1 = Storage::url($filePath);
    }

    
     // Verificar si se subió una nueva imagen
         if ($request->hasFile('icono2')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($nosotros->icono2)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $nosotros->icono2);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('icono2');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $nosotros->icono2 = Storage::url($filePath);
    }

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('icono3')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($nosotros->icono3)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $nosotros->icono3);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('icono3');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $nosotros->icono3 = Storage::url($filePath);
    }

    
        $nosotros->save();

        return redirect()->route('adm.nosotros', ['nosotro_id' => $nosotros->id]);
    }

}
