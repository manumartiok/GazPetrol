@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar banner Home</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar banner</h3>
            </div>
            <hr>
            
            <form method="POST" action="{{ route('adm.comercializacion-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="comercios_id" value="{{ $comercio->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto</label>

                    @if (!empty($comercio->foto))
                        <img :src="foto.foto || '{{ $comercio->foto }}'" alt="Foto" style="width: 20%;" class="mb-3">
                    @endif

                    <input type="file" name="foto" id="foto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" value="{{ $comercio->orden ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Título" value="{{ $comercio->titulo ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto</label>
                        <input type="text" id="texto" name="texto" placeholder="Texto" value="{{ $comercio->texto ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection