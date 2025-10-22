<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home_banners=HomeBanner::all();
        return view('content.admin.home-banner',['home_banner'=>$home_banners]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.home-banner-creador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $home_banners= new HomeBanner();
        $home_banners->orden=$request->orden;
        $home_banners->titulo=$request->titulo;
        $home_banners->texto=$request->texto;

        // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($home_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $home_banners->foto);
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
        $home_banners->foto = Storage::url($filePath);
    }

        $home_banners->save();
    return redirect()->route('adm.home-ban');
    }

    /**
     * Display the specified resource.
     */
    public function show($home_banners_id)
    {
               $home_banners=HomeBanner::find($home_banners_id);
        return view('content.admin.home-banner-editor' ,['home_banner'=>$home_banners]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $home_banners= HomeBanner::find($request->home_banners_id);
        
        if(!$home_banners){
            $home_banners=new HomeBanner();
        }
            $home_banners->orden=$request->orden;
            $home_banners->titulo=$request->titulo;
            $home_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
         if ($request->hasFile('foto')) {

        // 🧹 Borrar la foto anterior (si existe)
        if (!empty($home_banners->foto)) {
            // Convertir la URL tipo "/storage/images/xxx.jpg" a ruta real
            $oldPath = str_replace('/storage/', 'public/', $home_banners->foto);
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
        $home_banners->foto = Storage::url($filePath);
    }
        $home_banners->save();

        return redirect()->route('adm.home-ban', ['home_banner' => $home_banners->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($home_banners_id){
        $home_banners = HomeBanner::find($home_banners_id);

        if ($home_banners) {
        // Obtener la ruta de la imagen
        $imagePath = str_replace('/storage/', 'public/', $home_banners->foto); // Convierte la URL a la ruta de almacenamiento
        
        // Eliminar la imagen del sistema de archivos
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    
        $home_banners->delete();
    }
        
        return redirect()->route('adm.home-ban');
    }
      

    public function switch($home_banners_id){
        $home_banners=HomeBanner::find($home_banners_id);
        $home_banners->active= !$home_banners->active;
        $home_banners->save();
        return redirect()->route('adm.home-ban');
      }
}
