<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos=Producto::all();
        return view('content.admin.producto',['producto'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('active', true)->orderBy('orden')->get();
        return view('content.admin.producto-creador', ['categoria'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productos= new Producto();
        $productos->categoria_id=$request->categoria_id;
        $productos->orden=$request->orden;
        $productos->nombre=$request->nombre;
        $productos->detalle=$request->detalle;

        // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto_producto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($productos->foto_producto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $productos->foto_producto);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('foto_producto');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $productos->foto_producto = Storage::url($filePath);
    }

        $productos->save();
    return redirect()->route('adm.productos');
    }

    /**
     * Display the specified resource.
     */
    public function show($productos_id)
    {
            $productos=Producto::find($productos_id);
            $categorias=Categoria::where('active',true)->get();
        return view('content.admin.producto-editor' ,['producto'=>$productos, 'categoria'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $productos= Producto::find($request->productos_id);
        
        if(!$productos){
            $productos=new Producto();
        }
            $productos->categoria_id=$request->categoria_id;
            $productos->orden=$request->orden;
            $productos->nombre=$request->nombre;
            $productos->detalle=$request->detalle;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto_producto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($productos->foto_producto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $productos->foto_producto);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
        }

        // 📸 Guardar la nueva foto
        $file = $request->file('foto_producto');
        $name = time() . '.' . $file->getClientOriginalName();
        $filePath = 'public/images/' . $name;
        Storage::put($filePath, file_get_contents($file));

        // Guardar la ruta accesible públicamente
        $productos->foto_producto = Storage::url($filePath);
    }
        $productos->save();

        return redirect()->route('adm.productos', ['producto' => $productos->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productos_id){
        $productos = Producto::find($productos_id);

        if ($productos) {
        // Obtener la ruta de la imagen
        $imagePath = str_replace('/storage/', 'public/', $productos->foto_producto); // Convierte la URL a la ruta de almacenamiento
        
        // Eliminar la imagen del sistema de archivos
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    
        $productos->delete();
    }
        
        return redirect()->route('adm.productos');
    }
      

    public function switch($productos_id){
        $productos=Producto::find($productos_id);
        $productos->active= !$productos->active;
        $productos->save();
        return redirect()->route('adm.productos');
      }
}
