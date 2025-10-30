<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function show($contactos_id=null)

    {
        
        $contactos=Contacto::first();
        
        if(!$contactos){
            $contactos=new Contacto();
        }
        return view('content.admin.contacto', ['contacto'=>$contactos]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $contactos= Contacto::find($request->contactos_id);
        
        if(!$contactos){
            $contactos=new Contacto();
        }

            $contactos->titulo=$request->titulo;
            $contactos->sub=$request->sub;
            $contactos->texto=$request->texto;
            $contactos->ubicacion=$request->ubicacion;

        $contactos->save();

        return redirect()->route('adm.contacto', ['contacto_id' => $contactos->id])
            ->with('success', 'Información de contacto actualizada correctamente.');
    }
}
