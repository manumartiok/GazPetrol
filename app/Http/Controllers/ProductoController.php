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
        $productos = Producto::all();
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
}