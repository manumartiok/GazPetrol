<?php

namespace App\Http\Controllers;

use App\Models\Institucional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitucionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institucionales=Institucional::all();
        return view('content.admin.institucional',['institucional'=>$institucionales]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.institucional-creador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $institucionales= new Institucional();
        $institucionales->orden=$request->orden;
        $institucionales->titulo=$request->titulo;
        $institucionales->texto=$request->texto;

        // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($institucionales->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $institucionales->foto);
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
        $institucionales->foto = Storage::url($filePath);
    }

        $institucionales->save();
    return redirect()->route('adm.institucional');
    }

    /**
     * Display the specified resource.
     */
    public function show($institucionales_id)
    {
            $institucionales=Institucional::find($institucionales_id);
        return view('content.admin.institucional-editor' ,['institucional'=>$institucionales]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $institucionales= Institucional::find($request->institucionales_id);
        
        if(!$institucionales){
            $institucionales=new Institucional();
        }
            $institucionales->orden=$request->orden;
            $institucionales->titulo=$request->titulo;
            $institucionales->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($institucionales->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $institucionales->foto);
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
        $institucionales->foto = Storage::url($filePath);
    }
        $institucionales->save();

        return redirect()->route('adm.institucional', ['institucional' => $institucionales->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($institucionales_id){
        $institucionales = Institucional::find($institucionales_id);

        if ($institucionales) {
        // Obtener la ruta de la imagen
        $imagePath = str_replace('/storage/', 'public/', $institucionales->foto); // Convierte la URL a la ruta de almacenamiento
        
        // Eliminar la imagen del sistema de archivos
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    
        $institucionales->delete();
    }
        
        return redirect()->route('adm.institucional');
    }
      

    public function switch($institucionales_id){
        $institucionales=Institucional::find($institucionales_id);
        $institucionales->active= !$institucionales->active;
        $institucionales->save();
        return redirect()->route('adm.institucional');
      }

    public function destacado($institucionales_id){
        $institucionales=Institucional::find($institucionales_id);
        $institucionales->destacado= !$institucionales->destacado;
        $institucionales->save();
        return redirect()->route('adm.institucional');
      }
}
