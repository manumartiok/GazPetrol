<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $home_banners = HomeBanner::all();
        return view('content.admin.home-banner', ['home_banner' => $home_banners]);
    }

    public function create()
    {
        return view('content.admin.home-banner-creador');
    }

    public function store(Request $request)
    {
        $home_banners = new HomeBanner();
        $home_banners->orden = $request->orden;
        $home_banners->titulo = $request->titulo;
        $home_banners->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($home_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $home_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $home_banners->foto = Storage::url($path);
        }

        $home_banners->save();
        return redirect()->route('adm.home-ban');
    }

    public function show($home_banners_id)
    {
        $home_banners = HomeBanner::find($home_banners_id);
        return view('content.admin.home-banner-editor', ['home_banner' => $home_banners]);
    }

    public function update(Request $request)
    {
        $home_banners = HomeBanner::find($request->home_banners_id) ?? new HomeBanner();
        $home_banners->orden = $request->orden;
        $home_banners->titulo = $request->titulo;
        $home_banners->texto = $request->texto;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($home_banners->foto)) {
                $oldPath = str_replace('/storage/', '', $home_banners->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $home_banners->foto = Storage::url($path);
        }

        $home_banners->save();
        return redirect()->route('adm.home-ban', ['home_banner' => $home_banners->id]);
    }

    public function destroy($home_banners_id)
    {
        $home_banners = HomeBanner::find($home_banners_id);

        if ($home_banners) {
            if (!empty($home_banners->foto)) {
                $imagePath = str_replace('/storage/', '', $home_banners->foto);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $home_banners->delete();
        }

        return redirect()->route('adm.home-ban');
    }

    public function switch($home_banners_id)
    {
        $home_banners = HomeBanner::find($home_banners_id);
        $home_banners->active = !$home_banners->active;
        $home_banners->save();
        return redirect()->route('adm.home-ban');
    }
}