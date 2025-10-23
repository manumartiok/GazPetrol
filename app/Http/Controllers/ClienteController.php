<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('content.admin.clientes', ['cliente' => $clientes]);
    }

    public function create()
    {
        return view('content.admin.clientes-creador');
    }

    public function store(Request $request)
    {
        $clientes = new Cliente();
        $clientes->orden = $request->orden;
        $clientes->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            // Borrar foto anterior si existiera (por si se reutiliza el objeto)
            if (!empty($clientes->foto)) {
                $oldPath = str_replace('/storage/', '', $clientes->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $clientes->foto = Storage::url($path);
        }

        $clientes->save();
        return redirect()->route('adm.clientes');
    }

    public function show($clientes_id)
    {
        $clientes = Cliente::find($clientes_id);
        return view('content.admin.clientes-editor', ['cliente' => $clientes]);
    }

    public function update(Request $request)
    {
        $clientes = Cliente::find($request->clientes_id) ?? new Cliente();
        $clientes->orden = $request->orden;
        $clientes->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($clientes->foto)) {
                $oldPath = str_replace('/storage/', '', $clientes->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $clientes->foto = Storage::url($path);
        }

        $clientes->save();
        return redirect()->route('adm.clientes', ['cliente' => $clientes->id]);
    }

    public function destroy($clientes_id)
    {
        $clientes = Cliente::find($clientes_id);

        if ($clientes) {
            if (!empty($clientes->foto)) {
                $imagePath = str_replace('/storage/', '', $clientes->foto);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $clientes->delete();
        }

        return redirect()->route('adm.clientes');
    }

    public function switch($clientes_id)
    {
        $clientes = Cliente::find($clientes_id);
        $clientes->active = !$clientes->active;
        $clientes->save();
        return redirect()->route('adm.clientes');
    }

    public function destacado($clientes_id)
    {
        $clientes = Cliente::find($clientes_id);
        $clientes->destacado = !$clientes->destacado;
        $clientes->save();
        return redirect()->route('adm.clientes');
    }
}