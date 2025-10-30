<?php

namespace App\Http\Controllers;

use App\Models\InstitucionalBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitucionalBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($institucionales_banners_id = null)
    {
        $institucionales_banners = InstitucionalBanner::first();

        if (!$institucionales_banners) {
            $institucionales_banners = new InstitucionalBanner();
        }

        return view('content.admin.institucional-banner', [
            'institucional_banners' => $institucionales_banners
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|max:2048', // 2 MB = 2048 KB
        ]);
        
        $institucionales_banners = InstitucionalBanner::find($request->institucionales_banners_id) ?? new InstitucionalBanner();
        $institucionales_banners->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($institucionales_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $institucionales_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $institucionales_banners->foto = Storage::url($path);
        }

        $institucionales_banners->save();

        return redirect()->route('adm.institucional-ban', [
            'institucional_banners_id' => $institucionales_banners->id
        ]);
    }
}