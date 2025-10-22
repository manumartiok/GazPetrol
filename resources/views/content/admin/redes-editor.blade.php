@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar Redes</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar red</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.redes-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="redes_id" value="{{ $red->id ?? '' }}">

                <div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" value="{{ $red->orden ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{ $red->nombre ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="url">URL</label>
                        <input type="text" id="url" name="url" placeholder="Url" value="{{ $red->url ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="icono">Icono</label>
                        <select name="icono" id="icono"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled {{ empty($red->icono ?? '') ? 'selected' : '' }}>Seleccionar red...</option>
                            <option value="fa-instagram" {{ ($red->icono ?? '') == 'fa-instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="fa-facebook" {{ ($red->icono ?? '') == 'fa-facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="fa-twitter" {{ ($red->icono ?? '') == 'fa-x-twitter' ? 'selected' : '' }}>Twitter</option>
                            <option value="fa-youtube" {{ ($red->icono ?? '') == 'fa-youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="fa-whatsapp" {{ ($red->icono ?? '') == 'fa-whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            <option value="fa-linkedin" {{ ($red->icono ?? '') == 'fa-linkedin' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="fa-telegram" {{ ($red->icono ?? '') == 'fa-telegram' ? 'selected' : '' }}>Telegram</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection