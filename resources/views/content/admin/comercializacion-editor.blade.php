@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Editar comercialización</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Editar contenido</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.comercializacion-update') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                @csrf
                <input type="hidden" name="comercios_id" value="{{ $comercio->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto (recomendado 600x400)</label>

                    @if (!empty($comercio->foto))
                        <img :src="foto.foto || '{{ $comercio->foto }}'" alt="Foto" class="mb-3  max-w-[300] max-h-[240px] object-cover">
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
                        <label class="block text-gray-700 font-medium mb-2" for="detalle">Texto</label>

                        {{-- 🔽 Editor Quill --}}
                        <div class="quill-editor bg-white" data-field="texto" style="height: 150px;">
                            {!! $comercio->texto ?? '' !!}
                        </div>

                        {{-- Campo oculto que guarda el HTML del Quill --}}
                        <input type="hidden" name="texto" id="texto">
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