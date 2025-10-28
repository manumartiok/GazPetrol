@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Editar banner Productos</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar banner</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.productos-ban-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="productos_banners_id" value="{{ $producto_banners->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto (recomendado 1366x450)</label>

                    @if (!empty($producto_banners->foto))
                        <img :src="foto.foto || '{{ $producto_banners->foto }}'" alt="Foto"  class="mb-3 w-full max-w-[1366px] h-[450px] object-cover">
                    @endif

                    <input type="file" name="foto" id="foto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Título</label>
                        <input type="text" id="texto" name="texto" placeholder="Título" value="{{ $producto_banners->texto ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection