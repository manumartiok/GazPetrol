@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Editar banner Home</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Editar banner</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.home-ban-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="home_banners_id" value="{{ $home_banner->id ?? '' }}">

                <div>
                    <div class="mb-4 ">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto (recomendado 1366x768) / (2MB tamaño máximo)</label>

                    @if (!empty($home_banner->foto))
                        <img :src="foto.foto || '{{ $home_banner->foto }}'" alt="Foto" class="mb-3  w-full max-w-[1366px] h-[768px] object-cover">
                    @endif

                    <input type="file" name="foto" id="foto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" value="{{ $home_banner->orden ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Título" value="{{ $home_banner->titulo ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto</label>
                        <input type="text" id="texto" name="texto" placeholder="Texto" value="{{ $home_banner->texto ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4 bg-white">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection