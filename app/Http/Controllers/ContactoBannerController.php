<?php

namespace App\Http\Controllers;

use App\Models\ContactoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($contactos_banners_id=null)

    {
        
        $contactos_banners=ContactoBanner::first();
        
        if(!$contactos_banners){
            $contactos_banners=new ContactoBanner();
        }
        return view('content.admin.contacto-banner', ['contacto_banners'=>$contactos_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $contactos_banners= ContactoBanner::find($request->contactos_banners_id);
        
        if(!$contactos_banners){
            $contactos_banners=new ContactoBanner();
        }

            $contactos_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($contactos_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $contactos_banners->foto);
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
        $contactos_banners->foto = Storage::url($filePath);
    }
        $contactos_banners->save();

        return redirect()->route('adm.contacto-ban', ['contacto_banners_id' => $contactos_banners->id]);
    }
}
