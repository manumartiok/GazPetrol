<?php

namespace App\Http\Controllers;

use App\Models\ComercializacionBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComercializacionBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($comercios_banners_id = null)
    {
        $comercios_banners = ComercializacionBanner::first();

        if (!$comercios_banners) {
            $comercios_banners = new ComercializacionBanner();
        }

        return view('content.admin.comercializacion-banner', [
            'comercio_banners' => $comercios_banners
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $comercios_banners = ComercializacionBanner::find($request->comercios_banners_id) ?? new ComercializacionBanner();
        $comercios_banners->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            // Borrar foto anterior si existiera
            if (!empty($comercios_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $comercios_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $comercios_banners->foto = Storage::url($path);
        }

        $comercios_banners->save();

        return redirect()->route('adm.comercializacion-ban', [
            'comercio_banners_id' => $comercios_banners->id
        ]);
    }
}