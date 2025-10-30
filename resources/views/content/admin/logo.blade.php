@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Logos</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Editar Logo</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.logo-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="logos_id" value="{{ $logo->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto barra de navegacion (recomendado 222x53) / (2MB tamaño máximo)</label>

                    @if (!empty($logo->foto_nav))
                        <img :src="foto.foto_nav || '{{ $logo->foto_nav }}'" alt="Foto" class="mb-3 w-full max-w-[222px] h-[53px] object-cover">
                    @endif

                    <input type="file" name="foto_nav" id="foto_nav" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                     <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto footer (recomendado 222x53) / (2MB tamaño máximo)</label>

                    @if (!empty($logo->foto_footer))
                        <img :src="foto.foto_footer || '{{ $logo->foto_footer}}'" alt="Foto" class="mb-3 w-full max-w-[222px] h-[53px] object-cover">
                    @endif

                    <input type="file" name="foto_footer" id="foto_footer" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                </div>
                <button type="submit" class="border rounded p-4 bg-white">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection