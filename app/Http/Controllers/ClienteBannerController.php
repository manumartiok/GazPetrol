<?php

namespace App\Http\Controllers;

use App\Models\ClienteBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($clientes_banners_id=null)

    {
        
        $clientes_banners=ClienteBanner::first();
        
        if(!$clientes_banners){
            $clientes_banners=new ClienteBanner();
        }
        return view('content.admin.clientes-banner', ['cliente_banners'=>$clientes_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $clientes_banners= ClienteBanner::find($request->clientes_banners_id);
        
        if(!$clientes_banners){
            $clientes_banners=new ClienteBanner();
        }

            $clientes_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($clientes_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $clientes_banners->foto);
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
        $clientes_banners->foto = Storage::url($filePath);
    }
        $clientes_banners->save();

        return redirect()->route('adm.clientes-ban', ['cliente_banners_id' => $clientes_banners->id]);
    }
}
