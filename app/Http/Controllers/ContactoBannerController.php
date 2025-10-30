<?php

namespace App\Http\Controllers;

use App\Models\ContactoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($contactos_banners_id = null)
    {
        $contactos_banners = ContactoBanner::first();

        if (!$contactos_banners) {
            $contactos_banners = new ContactoBanner();
        }

        return view('content.admin.contacto-banner', [
            'contacto_banners' => $contactos_banners
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
        
        $contactos_banners = ContactoBanner::find($request->contactos_banners_id) ?? new ContactoBanner();
        $contactos_banners->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($contactos_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $contactos_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $contactos_banners->foto = Storage::url($path);
        }

        $contactos_banners->save();

        return redirect()->route('adm.contacto-ban', ['contacto_banners_id' => $contactos_banners->id])
            ->with('success', 'Banner de contacto actualizado correctamente.');
    }
}