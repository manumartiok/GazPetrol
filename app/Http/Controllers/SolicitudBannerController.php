<?php

namespace App\Http\Controllers;

use App\Models\SolicitudBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($solicitudes_banners_id=null)

    {
        
        $solicitudes_banners=SolicitudBanner::first();
        
        if(!$solicitudes_banners){
            $solicitudes_banners=new SolicitudBanner();
        }
        return view('content.admin.solicitud-banner', ['solicitud_banners'=>$solicitudes_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $solicitudes_banners= SolicitudBanner::find($request->solicitudes_banners_id);
        
        if(!$solicitudes_banners){
            $solicitudes_banners=new SolicitudBanner();
        }

            $solicitudes_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($solicitudes_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $solicitudes_banners->foto);
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
        $solicitudes_banners->foto = Storage::url($filePath);
    }
        $solicitudes_banners->save();

        return redirect()->route('adm.solicitud-ban', ['solicitud_banners_id' => $solicitudes_banners->id]);
    }
}
