<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function show($homes_id=null)

    {
        
        $homes=Home::first();
        
        if(!$homes){
            $homes=new Home();
        }
        return view('content.admin.home', ['home'=>$homes]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $homes= Home::find($request->home_id);
        
        if(!$homes){
            $homes=new Home();
        }

            $homes->texto=$request->texto;
            $homes->sub_text=$request->sub_text;
            $homes->descripcion=$request->descripcion;
            $homes->texto2=$request->texto2;
            $homes->sub_text2=$request->sub_text2;
            $homes->texto3=$request->texto3;
            $homes->sub_text3=$request->sub_text3;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($homes->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $homes->foto);
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
        $homes->foto = Storage::url($filePath);
    }
        $homes->save();

        return redirect()->route('adm.home', ['home_id' => $homes->id]);
    }

}
