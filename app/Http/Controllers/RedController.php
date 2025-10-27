<?php

namespace App\Http\Controllers;

use App\Models\Red;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redes=Red::orderBy('orden')->get();
        return view('content.admin.redes',['red'=>$redes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.admin.redes-creador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $redes= new Red();
        $redes->orden=$request->orden;
        $redes->nombre=$request->nombre;
        $redes->url=$request->url;
        $redes->icono=$request->icono;

        $redes->save();
    return redirect()->route('adm.redes');
    }

    /**
     * Display the specified resource.
     */
    public function show($redes_id)
    {
               $redes=Red::find($redes_id);
        return view('content.admin.redes-editor' ,['red'=>$redes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $redes= Red::find($request->redes_id);
        
        if(!$redes){
            $redes=new Red();
        }
            $redes->orden=$request->orden;
            $redes->nombre=$request->nombre;
            $redes->url=$request->url;
            $redes->icono=$request->icono;

        $redes->save();

        return redirect()->route('adm.redes', ['red' => $redes->id]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($redes_id){
        $redes = Red::find($redes_id);

        $redes->delete();
    
        return redirect()->route('adm.redes');
    }
      

    public function switch($redes_id){
        $redes=Red::find($redes_id);
        $redes->active= !$redes->active;
        $redes->save();
        return redirect()->route('adm.redes');
      }

      
          public function reordenar(Request $request)
    {
        foreach ($request->orden as $redes) {
            \App\Models\Red::where('id', $redes['id'])->update(['orden' => $redes['orden']]);
        }

        return response()->json(['success' => true]);
    }  
}
