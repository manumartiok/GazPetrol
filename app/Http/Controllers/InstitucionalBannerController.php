<?php

namespace App\Http\Controllers;

use App\Models\InstitucionalBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitucionalBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($institucionales_banners_id=null)

    {
        
        $institucionales_banners=InstitucionalBanner::first();
        
        if(!$institucionales_banners){
            $institucionales_banners=new InstitucionalBanner();
        }
        return view('content.admin.institucional-banner', ['institucional_banners'=>$institucionales_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $institucionales_banners= InstitucionalBanner::find($request->institucionales_banners_id);
        
        if(!$institucionales_banners){
            $institucionales_banners=new InstitucionalBanner();
        }

            $institucionales_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($institucionales_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $institucionales_banners->foto);
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
        $institucionales_banners->foto = Storage::url($filePath);
    }
        $institucionales_banners->save();

        return redirect()->route('adm.institucional-ban', ['institucional_banners_id' => $institucionales_banners->id]);
    }
}
