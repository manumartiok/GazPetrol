<?php

namespace App\Http\Controllers;

use App\Models\ComercializacionBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComercializacionBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($comercios_banners_id=null)

    {
        
        $comercios_banners=ComercializacionBanner::first();
        
        if(!$comercios_banners){
            $comercios_banners=new ComercializacionBanner();
        }
        return view('content.admin.comercializacion-banner', ['comercio_banners'=>$comercios_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $comercios_banners= ComercializacionBanner::find($request->comercios_banners_id);
        
        if(!$comercios_banners){
            $comercios_banners=new ComercializacionBanner();
        }

            $comercios_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($comercios_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $comercios_banners->foto);
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
        $comercios_banners->foto = Storage::url($filePath);
    }
        $comercios_banners->save();

        return redirect()->route('adm.comercializacion-ban', ['comercio_banners_id' => $comercios_banners->id]);
    }
}
