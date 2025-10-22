@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar banner Contacto</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar banner</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.contacto-ban-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="contactos_banners_id" value="{{ $contacto_banners->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto</label>

                    @if (!empty($contacto_banners->foto))
                        <img :src="foto.foto || '{{ $contacto_banners->foto }}'" alt="Foto" style="width: 20%;" class="mb-3">
                    @endif

                    <input type="file" name="foto" id="foto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Título</label>
                        <input type="text" id="texto" name="texto" placeholder="Título" value="{{ $contacto_banners->texto ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection