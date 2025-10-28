@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Crear contenido comercializacion</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Crear contenido</h3>
            </div>
            <hr>
            
            <form method="POST" action="{{ route('adm.comercializacion-store') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                @csrf
                <input type="hidden" name="comercios_id" value="{{ $comercio->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Título" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                                        {{-- 🔽 Editor Quill para el detalle --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto</label>
                        <div class="quill-editor bg-white" data-field="texto" style="height: 150px;"></div>
                        <input type="hidden" name="texto" id="texto">
                    </div>

                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection
@push('scripts')
    @include('includes.quill-init')
@endpush