<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias=Categoria::orderBy('orden')->get();
        return view('content.admin.categoria',['categoria'=>$categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.categoria-creador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorias= new Categoria();
        $categorias->orden=$request->orden;
        $categorias->categoria=$request->categoria;
        $categorias->color = $request->color;

        $categorias->save();
    return redirect()->route('adm.categorias');
    }

    /**
     * Display the specified resource.
     */
    public function show($categorias_id)
    {
            $categorias=Categoria::find($categorias_id);
        return view('content.admin.categoria-editor' ,['categoria'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $categorias= Categoria::find($request->categorias_id);
        
        if(!$categorias){
            $categorias=new Categoria();
        }
            $categorias->orden=$request->orden;
            $categorias->categoria=$request->categoria;
            $categorias->color = $request->color;

        $categorias->save();

        return redirect()->route('adm.categorias', ['categoria' => $categorias->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categorias_id){
        $categorias = Categoria::find($categorias_id);

    
        $categorias->delete();
    
        
        return redirect()->route('adm.categorias');
    }
      

    public function switch($categorias_id){
        $categorias=Categoria::find($categorias_id);
        $categorias->active= !$categorias->active;
        $categorias->save();
        return redirect()->route('adm.categorias');
      }

        public function reordenar(Request $request)
    {
        foreach ($request->orden as $categorias) {
            \App\Models\Categoria::where('id', $categorias['id'])->update(['orden' => $categorias['orden']]);
        }

        return response()->json(['success' => true]);
    }      

}
