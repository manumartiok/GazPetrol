<?php

namespace App\Http\Controllers;

use App\Models\ProductoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($productos_banners_id=null)

    {
        
        $productos_banners=ProductoBanner::first();
        
        if(!$productos_banners){
            $productos_banners=new ProductoBanner();
        }
        return view('content.admin.productos-banner', ['producto_banners'=>$productos_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $productos_banners= ProductoBanner::find($request->productos_banners_id);
        
        if(!$productos_banners){
            $productos_banners=new ProductoBanner();
        }

            $productos_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($productos_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $productos_banners->foto);
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
        $productos_banners->foto = Storage::url($filePath);
    }
        $productos_banners->save();

        return redirect()->route('adm.productos-ban', ['producto_banners_id' => $productos_banners->id]);
    }
}
