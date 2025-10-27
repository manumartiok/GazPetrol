<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /** Mostrar lista de servicios */
    public function index()
    {
        $servicios = Servicio::orderBy('orden')->get();
        return view('content.admin.servicios', ['servicios' => $servicios]);
    }

    /** Formulario para crear nuevo servicio */
    public function create()
    {
        return view('content.admin.servicios-creador');
    }

    /** Guardar nuevo servicio */
    public function store(Request $request)
    {
        $servicio = new Servicio();
        $servicio->orden = $request->orden;
        $servicio->nombre = $request->nombre;
        $servicio->save();

        return redirect()->route('adm.servicios');
    }

    /** Formulario para editar un servicio */
    public function show($servicio_id)
    {
        $servicio = Servicio::find($servicio_id);
        return view('content.admin.servicios-editor', ['servicio' => $servicio]);
    }

    /** Actualizar servicio */
    public function update(Request $request)
    {
        $servicio = Servicio::find($request->servicio_id);

        if (!$servicio) {
            $servicio = new Servicio();
        }

        $servicio->orden = $request->orden;
        $servicio->nombre = $request->nombre;
        $servicio->save();

        return redirect()->route('adm.servicios');
    }

    /** Eliminar servicio */
    public function destroy($servicio_id)
    {
        $servicio = Servicio::find($servicio_id);
        $servicio->delete();

        return redirect()->route('adm.servicios');
    }

    /** Activar / Desactivar servicio */
    public function switch($servicio_id)
    {
        $servicio = Servicio::find($servicio_id);
        $servicio->active = !$servicio->active;
        $servicio->save();

        return redirect()->route('adm.servicios');
    }

    /** Reordenar servicios (drag & drop) */
    public function reordenar(Request $request)
    {
        foreach ($request->orden as $item) {
            Servicio::where('id', $item['id'])->update(['orden' => $item['orden']]);
        }

        return response()->json(['success' => true]);
    }
}
