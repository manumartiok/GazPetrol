@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar Persona</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar persona</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.institucional-persona-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="personas_id" value="{{ $persona->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto</label>

                    @if (!empty($persona->foto))
                        <img :src="foto.foto || '{{ $persona->foto }}'" alt="Foto" style="width: 20%;" class="mb-3">
                    @endif

                    <input type="file" name="foto" id="foto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{ $persona->nombre ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                     <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="cargo">Cargo</label>
                        <input type="text" id="cargo" name="cargo" placeholder="Cargo" value="{{ $persona->cargo ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto1">Texto izquierda</label>
                        <input type="text" id="texto1" name="texto1" placeholder="Texto" value="{{ $persona->texto1 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto2">Texto derecha</label>
                        <input type="text" id="texto2" name="texto2" placeholder="Texto" value="{{ $persona->texto2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection