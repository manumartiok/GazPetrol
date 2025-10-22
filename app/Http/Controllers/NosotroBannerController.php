<?php

namespace App\Http\Controllers;

use App\Models\NosotroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NosotroBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($nosotros_banners_id=null)

    {
        
        $nosotros_banners=NosotroBanner::first();
        
        if(!$nosotros_banners){
            $nosotros_banners=new NosotroBanner();
        }
        return view('content.admin.nosotros-banner', ['nosotro_banners'=>$nosotros_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $nosotros_banners= NosotroBanner::find($request->nosotros_banners_id);
        
        if(!$nosotros_banners){
            $nosotros_banners=new NosotroBanner();
        }

            $nosotros_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($nosotros_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $nosotros_banners->foto);
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
        $nosotros_banners->foto = Storage::url($filePath);
    }
        $nosotros_banners->save();

        return redirect()->route('adm.nosotros-ban', ['nosotro_banners_id' => $nosotros_banners->id]);
    }
}
