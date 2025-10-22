<?php

namespace App\Http\Controllers;

use App\Models\ProductoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        $productos_fotos= new ProductoFoto();
        $productos_fotos->productos_id=$request->productos_id;
        $productos_fotos->orden=$request->orden;

        // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($productos_fotos->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $productos_fotos->foto);
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
        $productos_fotos->foto = Storage::url($filePath);
    }

        $productos_fotos->save();
    return redirect()->route('adm.productos-editor', ['producto_id' => $request->productos_id]);
    }

    /**
     * Display the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productos_fotos_id){
        $productos_fotos = ProductoFoto::find($productos_fotos_id);

        if ($productos_fotos) {
        // Obtener la ruta de la imagen
        $imagePath = str_replace('/storage/', 'public/', $productos_fotos->foto_producto); // Convierte la URL a la ruta de almacenamiento
        
        // Eliminar la imagen del sistema de archivos
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        
        $producto_id = $productos_fotos->productos_id; //  Guardamos el ID antes de borrar
        $productos_fotos->delete();
    }
        
        return redirect()->route('adm.productos-editor', ['producto_id' => $producto_id]);
    }
      

    public function switch($productos_fotos_id){
        $productos_fotos=ProductoFoto::find($productos_fotos_id);
        $productos_fotos->active= !$productos_fotos->active;
        $productos_fotos->save();
        return redirect()->route('adm.productos-editor', ['producto_id' => $productos_fotos->productos_id]);
      }

    public function reordenar(Request $request)
    {
        foreach ($request->orden as $foto) {
            \App\Models\ProductoFoto::where('id', $foto['id'])->update(['orden' => $foto['orden']]);
        }

        return response()->json(['success' => true]);
    }      
}
