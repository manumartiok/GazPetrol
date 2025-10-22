<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($logos_id=null)

    {
        
        $logos=Logo::first();
        
        if(!$logos){
            $logos=new Logo();
        }
        return view('content.admin.logo', ['logo'=>$logos]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $logos= Logo::find($request->logos_id);
        
        if(!$logos){
            $logos=new Logo();
        }

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto_nav')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($logos->foto_nav)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $logos->foto_nav);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('foto_nav');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $logos->foto_nav = Storage::url($filePath);
    }


         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto_footer')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($logos->foto_footer)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $logos->foto_footer);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('foto_footer');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $logos->foto_footer = Storage::url($filePath);
    }
        $logos->save();

        return redirect()->route('adm.logo', ['logo_id' => $logos->id]);
    }
}
