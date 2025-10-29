<?php

namespace App\Http\Controllers;

use App\Models\ProductoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoFotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fotos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotosSubidas = [];
        
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $file) {
                $productos_fotos = new ProductoFoto();
                $productos_fotos->productos_id = $request->productos_id;
                $productos_fotos->active = true; // 👈 Agregar esto
                
                // Si hay un orden base, sumamos el índice
                $ordenBase = $request->orden ?? 0;
                $productos_fotos->orden = $ordenBase + $index;

                $name = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('images', $name, 'public');
                $productos_fotos->foto = Storage::url($path);

                $productos_fotos->save();
                
                $fotosSubidas[] = [
                    'id' => $productos_fotos->id,
                    'orden' => $productos_fotos->orden,
                    'foto' => asset($productos_fotos->foto),
                    'active' => $productos_fotos->active,
                    // 👇 Agregar las rutas completas
                    'switch_url' => route('adm.productos-fotos-switch', $productos_fotos->id),
                    'destroy_url' => route('adm.productos-fotos-destroy', $productos_fotos->id)
                ];
            }
        }

        // Si es AJAX, devolver JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'fotos' => $fotosSubidas,
                'message' => count($fotosSubidas) . ' foto(s) subida(s) correctamente'
            ]);
        }

        // Si no es AJAX, redirigir como antes
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

            $producto_id = $productos_fotos->productos_id;
            $productos_fotos->delete();

            // Si es AJAX, devolver JSON
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Foto eliminada correctamente'
                ]);
            }

            return redirect()->route('adm.productos-editor', ['producto_id' => $producto_id]);
        }

        // Si es AJAX y no se encontró la foto
        if (request()->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Foto no encontrada'
            ], 404);
        }

        return redirect()->back()->with('error', 'Foto no encontrada');
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