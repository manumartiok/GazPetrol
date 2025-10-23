<?php

namespace App\Http\Controllers;

use App\Models\ProductoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoFotoController extends Controller
{
    public function store(Request $request)
    {
        $productos_fotos = new ProductoFoto();
        $productos_fotos->productos_id = $request->productos_id;
        $productos_fotos->orden = $request->orden;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($productos_fotos->foto)) {
                $oldPath = str_replace('/storage/', '', $productos_fotos->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $productos_fotos->foto = Storage::url($path);
        }

        $productos_fotos->save();

        return redirect()->route('adm.productos-editor', ['producto_id' => $request->productos_id]);
    }

    public function destroy($productos_fotos_id)
    {
        $productos_fotos = ProductoFoto::find($productos_fotos_id);

        if ($productos_fotos) {
            if (!empty($productos_fotos->foto)) {
                $imagePath = str_replace('/storage/', '', $productos_fotos->foto);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            $producto_id = $productos_fotos->productos_id; // Guardamos el ID antes de borrar
            $productos_fotos->delete();
        }

        return redirect()->route('adm.productos-editor', ['producto_id' => $producto_id]);
    }

    public function switch($productos_fotos_id)
    {
        $productos_fotos = ProductoFoto::find($productos_fotos_id);
        $productos_fotos->active = !$productos_fotos->active;
        $productos_fotos->save();

        return redirect()->route('adm.productos-editor', ['producto_id' => $productos_fotos->productos_id]);
    }

    public function reordenar(Request $request)
    {
        foreach ($request->orden as $foto) {
            ProductoFoto::where('id', $foto['id'])->update(['orden' => $foto['orden']]);
        }

        return response()->json(['success' => true]);
    }
}