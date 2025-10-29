<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('orden')->get();
        return view('content.admin.producto', ['producto' => $productos]);
    }

    public function create()
    {
        $categorias = Categoria::where('active', true)->orderBy('orden')->get();
        return view('content.admin.producto-creador', ['categoria' => $categorias]);
    }

    public function store(Request $request)
    {
        $productos = new Producto();
        $productos->categoria_id = $request->categoria_id;
        $productos->orden = $request->orden;
        $productos->nombre = $request->nombre;
        $productos->detalle = $request->detalle;

        // Manejo de foto
        if ($request->hasFile('foto_producto')) {
            if (!empty($productos->foto_producto)) {
                $oldPath = str_replace('/storage/', '', $productos->foto_producto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto_producto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $productos->foto_producto = Storage::url($path);
        }

        // Manejo de ficha técnica
        if ($request->hasFile('ficha_tecnica')) {
            if (!empty($productos->ficha_tecnica)) {
                $oldPath = str_replace('/storage/', '', $productos->ficha_tecnica);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('ficha_tecnica');
            $name = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('fichas', $name, 'public');
            $productos->ficha_tecnica = Storage::url($path);
        }

        $productos->save();
        return redirect()->route('adm.productos');
    }

    public function show($productos_id)
    {
        $productos = Producto::find($productos_id);
        $categorias = Categoria::where('active', true)->get();
        return view('content.admin.producto-editor', ['producto' => $productos, 'categoria' => $categorias]);
    }

    public function update(Request $request)
    {
        $productos = Producto::find($request->productos_id) ?? new Producto();
        $productos->categoria_id = $request->categoria_id;
        $productos->orden = $request->orden;
        $productos->nombre = $request->nombre;
        $productos->detalle = $request->detalle;

        // Manejo de foto
        if ($request->hasFile('foto_producto')) {
            if (!empty($productos->foto_producto)) {
                $oldPath = str_replace('/storage/', '', $productos->foto_producto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto_producto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $productos->foto_producto = Storage::url($path);
        }

        // Manejo de ficha técnica
        if ($request->hasFile('ficha_tecnica')) {
            if (!empty($productos->ficha_tecnica)) {
                $oldPath = str_replace('/storage/', '', $productos->ficha_tecnica);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

        $file = $request->file('ficha_tecnica');
        $name = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('fichas', $name, 'public');
        $productos->ficha_tecnica = Storage::url($path);
    }

        $productos->save();
        return redirect()->route('adm.productos', ['producto' => $productos->id]);
    }

    public function destroy($productos_id)
    {
        $productos = Producto::find($productos_id);

        if ($productos) {
            if (!empty($productos->foto_producto)) {
                $imagePath = str_replace('/storage/', '', $productos->foto_producto);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $productos->delete();
        }

        return redirect()->route('adm.productos');
    }

    public function switch($productos_id)
    {
        $productos = Producto::find($productos_id);
        $productos->active = !$productos->active;
        $productos->save();
        return redirect()->route('adm.productos');
    }

         public function reordenar(Request $request)
    {
        foreach ($request->orden as $productos) {
            \App\Models\Producto::where('id', $productos['id'])->update(['orden' => $productos['orden']]);
        }

        return response()->json(['success' => true]);
    }    

    public function detalle($id, Request $request)
    {
    $categorias = Categoria::where('active', true)->orderBy('orden')->get();
    $producto = Producto::with('categoria', 'fotos')->findOrFail($id); // con relaciones
    $productos = Producto::where('active', true)->orderBy('orden')->get();

    // Recibir la categoría seleccionada (opcional)
    $categoria_seleccionada = $request->query('categoria');

    return view('content.web.productos-detalle', compact(
         'categorias', 'producto', 'productos', 'categoria_seleccionada'
    ));
    }

    public function destroyFichaTecnica($producto_id)
    {
        $producto = Producto::find($producto_id);

        if ($producto && !empty($producto->ficha_tecnica)) {
            // Eliminar el archivo físico
            $fichaTecnicaPath = str_replace('/storage/', '', $producto->ficha_tecnica);
            if (Storage::disk('public')->exists($fichaTecnicaPath)) {
                Storage::disk('public')->delete($fichaTecnicaPath);
            }

            // Limpiar el campo en la base de datos
            $producto->ficha_tecnica = null;
            $producto->save();

            // Si es AJAX, devolver JSON
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ficha técnica eliminada correctamente'
                ]);
            }

            return redirect()->route('adm.productos-editor', ['producto_id' => $producto_id])
                ->with('success', 'Ficha técnica eliminada correctamente');
        }

        // Si es AJAX y no se encontró
        if (request()->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Producto o ficha técnica no encontrada'
            ], 404);
        }

        return redirect()->back()->with('error', 'Producto o ficha técnica no encontrada');
    }
}