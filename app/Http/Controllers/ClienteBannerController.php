<?php

namespace App\Http\Controllers;

use App\Models\ClienteBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function show($clientes_banners_id=null)

    {
        
        $clientes_banners=ClienteBanner::first();
        
        if(!$clientes_banners){
            $clientes_banners=new ClienteBanner();
        }
        return view('content.admin.clientes-banner', ['cliente_banners'=>$clientes_banners]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);

        $clientes_banners= ClienteBanner::find($request->clientes_banners_id);
        
        if(!$clientes_banners){
            $clientes_banners=new ClienteBanner();
        }

            $clientes_banners->texto=$request->texto;

         // Verificar si se subió una nueva imagen
        if ($request->hasFile('foto')) {

        // Borrar la foto anterior (si existe)
        if (!empty($clientes_banners->foto)) {
            // Convertir la URL pública a path relativo del disco
            $oldPath = str_replace('/storage/', '', $clientes_banners->foto);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Guardar la nueva foto
        $file = $request->file('foto');
        $name = time() . '.' . $file->getClientOriginalName();

        // Guardar en storage/app/public/images
        $path = $file->storeAs('images', $name, 'public');

        // Guardar la URL pública en la DB
        $clientes_banners->foto = Storage::url($path);
    }
        $clientes_banners->save();

        return redirect()->route('adm.clientes-ban', ['cliente_banners_id' => $clientes_banners->id])
            ->with('success', 'Banner de clientes actualizado correctamente.');
    }
}
