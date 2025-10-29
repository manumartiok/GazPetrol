@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Crear Institucional</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Crear contenido</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.institucional-store') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                @csrf
                <input type="hidden" name="institucionales_id" value="{{ $institucional->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto (recomendado 392x260)</label>
                    <input type="file" name="foto" id="foto" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Titulo</label>
                        <input type="text" id="titulo" name="titulo" placeholder="¿Quiénes somos?" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- 🔽 Editor Quill para el detalle --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto</label>
                        <div class="quill-editor bg-white" data-field="texto" style="height: 150px;"></div>
                        <input type="hidden" name="texto" id="texto">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4 bg-white">Crear</button>
            </form>
        </div>            
    </div>
@endsection


@push('scripts')
    @include('includes.quill-init')
@endpush