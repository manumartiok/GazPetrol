<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($homes_id = null)
    {
        $homes = Home::first();

        if (!$homes) {
            $homes = new Home();
        }

        return view('content.admin.home', ['home' => $homes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $homes = Home::find($request->home_id) ?? new Home();

        $homes->texto = $request->texto;
        $homes->sub_text = $request->sub_text;
        $homes->descripcion = $request->descripcion;
        $homes->texto2 = $request->texto2;
        $homes->sub_text2 = $request->sub_text2;
        $homes->texto3 = $request->texto3;
        $homes->sub_text3 = $request->sub_text3;

        // Manejo de foto
        if ($request->hasFile('foto')) {
            if (!empty($homes->foto)) {
                $oldPath = str_replace('/storage/', '', $homes->foto);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('foto');
            $name = time() . '.' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $name, 'public');
            $homes->foto = Storage::url($path);
        }

        $homes->save();

        return redirect()->route('adm.home', ['home_id' => $homes->id]);
    }
}