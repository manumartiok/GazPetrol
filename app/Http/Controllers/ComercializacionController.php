<?php

namespace App\Http\Controllers;

use App\Models\Comercializacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComercializacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comercios=Comercializacion::all();
        return view('content.admin.comercializacion',['comercio'=>$comercios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.comercializacion-creador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comercios= new Comercializacion();
        $comercios->orden=$request->orden;
        $comercios->titulo=$request->titulo;
        $comercios->texto=$request->texto;

        // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($comercios->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $comercios->foto);
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
        $comercios->foto = Storage::url($filePath);
    }

        $comercios->save();
    return redirect()->route('adm.comercializacion');
    }

    /**
     * Display the specified resource.
     */
    public function show($comercios_id)
    {
            $comercios=Comercializacion::find($comercios_id);
        return view('content.admin.comercializacion-editor' ,['comercio'=>$comercios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $comercios= Comercializacion::find($request->comercios_id);
        
        if(!$comercios){
            $comercios=new Comercializacion();
        }
            $comercios->orden=$request->orden;
            $comercios->titulo=$request->titulo;
            $comercios->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($comercios->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $comercios->foto);
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
        $comercios->foto = Storage::url($filePath);
    }
        $comercios->save();

        return redirect()->route('adm.comercializacion', ['comercio' => $comercios->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($comercios_id){
        $comercios = Comercializacion::find($comercios_id);

        if ($comercios) {
        // Obtener la ruta de la imagen
        $imagePath = str_replace('/storage/', 'public/', $comercios->foto); // Convierte la URL a la ruta de almacenamiento
        
        // Eliminar la imagen del sistema de archivos
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    
        $comercios->delete();
    }
        
        return redirect()->route('adm.comercializacion');
    }
      

    public function switch($comercios_id){
        $comercios=Comercializacion::find($comercios_id);
        $comercios->active= !$comercios->active;
        $comercios->save();
        return redirect()->route('adm.comercializacion');
      }
}
