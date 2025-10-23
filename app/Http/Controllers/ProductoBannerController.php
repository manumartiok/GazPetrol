<?php

namespace App\Http\Controllers;

use App\Models\ProductoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($productos_banners_id = null)
    {
        $productos_banners = ProductoBanner::first() ?? new ProductoBanner();
        return view('content.admin.productos-banner', ['producto_banners' => $productos_banners]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $productos_banners = ProductoBanner::find($request->productos_banners_id) ?? new ProductoBanner();

        // Manejo de la imagen
        if ($request->hasFile('foto')) {
            if (!empty($productos_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $productos_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $productos_banners->foto = Storage::url($path);
        }

        $productos_banners->texto = $request->texto;
        $productos_banners->save();

        return redirect()->route('adm.productos-ban', ['producto_banners_id' => $productos_banners->id]);
    }
}