<?php

namespace App\Http\Controllers;

use App\Models\SolicitudBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudBannerController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($solicitudes_banners_id = null)
    {
        $solicitudes_banners = SolicitudBanner::first();

        if (!$solicitudes_banners) {
            $solicitudes_banners = new SolicitudBanner();
        }

        return view('content.admin.solicitud-banner', ['solicitud_banners' => $solicitudes_banners]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);
        
        $solicitudes_banners = SolicitudBanner::find($request->solicitudes_banners_id) ?? new SolicitudBanner();
        $solicitudes_banners->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($solicitudes_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $solicitudes_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $solicitudes_banners->foto = Storage::url($path);
        }

        $solicitudes_banners->save();
        return redirect()->route('adm.solicitud-ban', ['solicitud_banners_id' => $solicitudes_banners->id])
            ->with('success', 'Banner de solicitud actualizado correctamente.');
    }
}