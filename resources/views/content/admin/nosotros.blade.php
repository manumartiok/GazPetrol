@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   
   {{-- cabezal  --}}
    <div>
        <h3>Nosotros</h3>
        <hr class="mx-6">
    </div>
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border rounded p-4">
            <div>
                <h3>Editar Nosotros</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.nosotros-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nosotro_id" value="{{ $nosotro->id ?? '' }}">

                <div>
                    <div class="mb-4">
                        <label class="form-label" for="">Video </label>
                        @if (!empty($nosotro->video))
                            <video autoplay loop muted playsinline width="20%" class="mb-3">
                                <source src="{{ $nosotro->video }}" type="video/mp4">
                                Tu navegador no soporta el video.
                            </video>
                        @endif  
                        <input type="file" name="video" class="form-control" accept="video/*" id="video"/>
                    </div>

                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Foto</label>

                        @if (!empty($nosotro->foto))
                            <img :src="foto.foto || '{{ $nosotro->foto }}'" alt="Foto" style="width: 20%;" class="mb-3">
                        @endif

                        <input type="file" name="foto" id="foto" @change="subirFoto"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Titulo</label>
                        <input type="text" id="texto_chico1" name="texto_chico1" placeholder="Texto" value="{{ $nosotro->texto_chico1 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Subtitulo</label>
                        <input type="text" id="texto_grande1" name="texto_grande1" placeholder="Título" value="{{ $nosotro->texto_grande2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="descripcion">Descripcion</label>
                        <input type="text" id="descripcion" name="descripcion" placeholder="¿Quiénes somos?" value="{{ $nosotro->descripcion ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Titulo 2</label>
                        <input type="text" id="texto_chico2" name="texto_chico2" placeholder="Texto" value="{{ $nosotro->texto_chico2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Subtitulo 2</label>
                        <input type="text" id="texto_grande2" name="texto_grande2" placeholder="Título" value="{{ $nosotro->texto_grande2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Logo 1</label>

                        @if (!empty($nosotro->icono1))
                            <img :src="foto.icono1 || '{{ $nosotro->icono1 }}'" alt="Foto" style="width: 20%;" class="mb-3">
                        @endif

                        <input type="file" name="icono1" id="icono1" @change="subirFoto"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Titulo logo 1</label>
                        <input type="text" id="nombre_icono1" name="nombre_icono1" placeholder="Texto" value="{{ $nosotro->nombre_icono1 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto logo 1</label>
                        <input type="text" id="texto_icono1" name="texto_icono1" placeholder="Título" value="{{ $nosotro->texto_icono1 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Logo 2</label>

                        @if (!empty($nosotro->icono2))
                            <img :src="foto.icono2 || '{{ $nosotro->icono2 }}'" alt="Foto" style="width: 20%;" class="mb-3">
                        @endif

                        <input type="file" name="icono2" id="icono2" @change="subirFoto"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Titulo logo 2</label>
                        <input type="text" id="nombre_icono2" name="nombre_icono2" placeholder="Texto" value="{{ $nosotro->nombre_icono2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto logo 2</label>
                        <input type="text" id="texto_icono2" name="texto_icono2" placeholder="Título" value="{{ $nosotro->texto_icono2 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Logo 3</label>

                        @if (!empty($nosotro->icono3))
                            <img :src="foto.icono3 || '{{ $nosotro->icono3 }}'" alt="Foto" style="width: 20%;" class="mb-3">
                        @endif

                        <input type="file" name="icono3" id="icono3" @change="subirFoto"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Titulo logo 3</label>
                        <input type="text" id="nombre_icono3" name="nombre_icono3" placeholder="Texto" value="{{ $nosotro->nombre_icono3 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="texto">Texto logo 3</label>
                        <input type="text" id="texto_icono3" name="texto_icono3" placeholder="Título" value="{{ $nosotro->texto_icono3 ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection