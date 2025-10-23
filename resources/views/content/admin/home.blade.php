@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar seccion Home</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div class="">
                <h3>Editar Home</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.home-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="home_id" value="{{ $home->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto</label>

                    @if (!empty($home->foto))
                        <img :src="foto.foto || '{{ $home->foto }}'" alt="Foto" style="width: 20%;" class="mb-3">
                    @endif

                    <input type="file" name="foto" id="foto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Título 1</label>
                        <input type="text" id="texto" name="texto" placeholder="Título" value="{{ $home->texto ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                     <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="sub_text">Subtitulo 1</label>
                        <input type="text" id="sub_text" name="sub_text" placeholder="Título" value="{{ $home->sub_text ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" placeholder="Descripcion"  
                            class="ckeditor w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            {{ $home->descripcion ?? '' }}
                        </textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto2">Título 2</label>
                        <input type="text" id="texto2" name="texto2" placeholder="Título" value="{{ $home->texto2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                     <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="sub_text2">Subtitulo 2</label>
                        <input type="text" id="sub_text2" name="sub_text2" placeholder="Título" value="{{ $home->sub_text2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto3">Título 3</label>
                        <input type="text" id="texto3" name="texto3" placeholder="Título" value="{{ $home->texto3 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                     <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="sub_text3">Subtitulo 3</label>
                        <input type="text" id="sub_text3" name="sub_text3" placeholder="Título" value="{{ $home->sub_text3 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <hr class="my-4">
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection