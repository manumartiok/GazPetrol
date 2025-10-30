<?php

namespace App\Http\Controllers;

use App\Models\Institucional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitucionalController extends Controller
{
    public function index()
    {
        $institucionales = Institucional::orderBy('orden')->get();
        return view('content.admin.institucional', ['institucional' => $institucionales]);
    }

    public function create()
    {
        return view('content.admin.institucional-creador');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);

        $institucionales = new Institucional();
        $institucionales->orden = $request->orden;
        $institucionales->titulo = $request->titulo;
        $institucionales->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($institucionales->foto)) {
                $oldPath = str_replace('/storage/', '', $institucionales->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $institucionales->foto = Storage::url($path);
        }

        $institucionales->save();
        return redirect()->route('adm.institucional');
    }

    public function show($institucionales_id)
    {
        $institucionales = Institucional::find($institucionales_id);
        return view('content.admin.institucional-editor', ['institucional' => $institucionales]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);
        
        $institucionales = Institucional::find($request->institucionales_id) ?? new Institucional();
        $institucionales->orden = $request->orden;
        $institucionales->titulo = $request->titulo;
        $institucionales->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($institucionales->foto)) {
                $oldPath = str_replace('/storage/', '', $institucionales->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $institucionales->foto = Storage::url($path);
        }

        $institucionales->save();
        return redirect()->route('adm.institucional', ['institucional' => $institucionales->id]);
    }

    public function destroy($institucionales_id)
    {
        $institucionales = Institucional::find($institucionales_id);

        if ($institucionales) {
            $imagePath = str_replace('/storage/', '', $institucionales->foto);
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $institucionales->delete();
        }

        return redirect()->route('adm.institucional');
    }

    public function switch($institucionales_id)
    {
        $institucionales = Institucional::find($institucionales_id);
        $institucionales->active = !$institucionales->active;
        $institucionales->save();

        return redirect()->route('adm.institucional');
    }

    public function destacado($institucionales_id)
    {
        $institucionales = Institucional::find($institucionales_id);
        $institucionales->destacado = !$institucionales->destacado;
        $institucionales->save();

        return redirect()->route('adm.institucional');
    }

    
          public function reordenar(Request $request)
    {
        foreach ($request->orden as $institucionales) {
            \App\Models\Institucional::where('id', $institucionales['id'])->update(['orden' => $institucionales['orden']]);
        }

        return response()->json(['success' => true]);
    }  
}