@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Editar Persona</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Editar persona</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.institucional-persona-update') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                @csrf
                <input type="hidden" name="personas_id" value="{{ $persona->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto (recomendado 155x192)</label>

                    @if (!empty($persona->foto))
                        <img :src="foto.foto || '{{ $persona->foto }}'" alt="Foto" class="mb-3 w-full max-w-[155px] h-[192px] object-cover">
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

                        {{-- 🔽 Editor Quill --}}
                        <div class="quill-editor bg-white" data-field="texto1" style="height: 150px;">
                            {!! $persona->texto1 ?? '' !!}
                        </div>

                        {{-- Campo oculto que guarda el HTML del Quill --}}
                        <input type="hidden" name="texto1" id="texto1">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto2">Texto derecha</label>

                        {{-- 🔽 Editor Quill --}}
                        <div class="quill-editor bg-white" data-field="texto2" style="height: 150px;">
                            {!! $persona->texto2 ?? '' !!}
                        </div>

                        {{-- Campo oculto que guarda el HTML del Quill --}}
                        <input type="hidden" name="texto2" id="texto2">
                    </div>

                </div>
                <button type="submit" class="border rounded p-4 bg-white">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection


@push('scripts')
    @include('includes.quill-init')
@endpush