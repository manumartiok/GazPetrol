<?php

namespace App\Http\Controllers;

use App\Models\Comercializacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComercializacionController extends Controller
{
    public function index()
    {
        $comercios = Comercializacion::orderBy('orden')->get();;
        return view('content.admin.comercializacion', ['comercio' => $comercios]);
    }

    public function create()
    {
        return view('content.admin.comercializacion-creador');
    }

    public function store(Request $request)
    {
        $comercios = new Comercializacion();
        $comercios->orden = $request->orden;
        $comercios->titulo = $request->titulo;
        $comercios->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($comercios->foto)) {
                $oldPath = str_replace('/storage/', '', $comercios->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $comercios->foto = Storage::url($path);
        }

        $comercios->save();
        return redirect()->route('adm.comercializacion');
    }

    public function show($comercios_id)
    {
        $comercios = Comercializacion::find($comercios_id);
        return view('content.admin.comercializacion-editor', ['comercio' => $comercios]);
    }

    public function update(Request $request)
    {
        $comercios = Comercializacion::find($request->comercios_id) ?? new Comercializacion();
        $comercios->orden = $request->orden;
        $comercios->titulo = $request->titulo;
        $comercios->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($comercios->foto)) {
                $oldPath = str_replace('/storage/', '', $comercios->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $comercios->foto = Storage::url($path);
        }

        $comercios->save();
        return redirect()->route('adm.comercializacion', ['comercio' => $comercios->id]);
    }

    public function destroy($comercios_id)
    {
        $comercios = Comercializacion::find($comercios_id);

        if ($comercios) {
            if (!empty($comercios->foto)) {
                $imagePath = str_replace('/storage/', '', $comercios->foto);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $comercios->delete();
        }

        return redirect()->route('adm.comercializacion');
    }

    public function switch($comercios_id)
    {
        $comercios = Comercializacion::find($comercios_id);
        $comercios->active = !$comercios->active;
        $comercios->save();
        return redirect()->route('adm.comercializacion');
    }

    
        public function reordenar(Request $request)
    {
        foreach ($request->orden as $comercios) {
            \App\Models\Comercializacion::where('id', $comercios['id'])->update(['orden' => $comercios['orden']]);
        }

        return response()->json(['success' => true]);
    }      

}