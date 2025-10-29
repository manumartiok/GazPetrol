@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Editar seccion Contacto</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Editar contacto</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.contacto-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="contactos_id" value="{{ $contacto->id ?? '' }}">
                <div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Titulo</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Titlo" value="{{ $contacto->titulo ?? '' }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="sub">Subtitulo</label>
                        <input type="text" id="sub" name="sub" placeholder="Subtitulo" value="{{ $contacto->sub ?? '' }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto </label>
                        <input type="text" id="texto" name="texto" placeholder="Texto" value="{{ $contacto->texto ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="ubicacion">Ubicacion</label>
                        <input type="text" id="ubicacion" name="ubicacion" placeholder="Ubicacion" value="{{ $contacto->ubicacion ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4 bg-white">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection