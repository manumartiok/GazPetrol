<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes=Cliente::all();
        return view('content.admin.clientes',['cliente'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.clientes-creador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $clientes= new Cliente();
        $clientes->orden=$request->orden;
        $clientes->texto=$request->texto;

        // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($clientes->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $clientes->foto);
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
        $clientes->foto = Storage::url($filePath);
    }

        $clientes->save();
    return redirect()->route('adm.clientes');
    }

    /**
     * Display the specified resource.
     */
    public function show($clientes_id)
    {
            $clientes=Cliente::find($clientes_id);
        return view('content.admin.clientes-editor' ,['cliente'=>$clientes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $clientes= Cliente::find($request->clientes_id);
        
        if(!$clientes){
            $clientes=new Cliente();
        }
            $clientes->orden=$request->orden;
            $clientes->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($clientes->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $clientes->foto);
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
        $clientes->foto = Storage::url($filePath);
    }
        $clientes->save();

        return redirect()->route('adm.clientes', ['cliente' => $clientes->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($clientes_id){
        $clientes = Cliente::find($clientes_id);

        if ($clientes) {
        // Obtener la ruta de la imagen
        $imagePath = str_replace('/storage/', 'public/', $clientes->foto); // Convierte la URL a la ruta de almacenamiento
        
        // Eliminar la imagen del sistema de archivos
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    
        $clientes->delete();
    }
        
        return redirect()->route('adm.clientes');
    }
      

    public function switch($clientes_id){
        $clientes=Cliente::find($clientes_id);
        $clientes->active= !$clientes->active;
        $clientes->save();
        return redirect()->route('adm.clientes');
      }

    public function destacado($clientes_id){
        $clientes=Cliente::find($clientes_id);
        $clientes->destacado= !$clientes->destacado;
        $clientes->save();
        return redirect()->route('adm.clientes');
      }
}
