    @extends('layouts.master')

    @section('title', 'Dashboard')

    @section('content')
    <div id="app">

    
    {{-- cabezal  --}}
        <div>
            <h3 class="text-[20px] font-bold text-gray-500">Nosotros</h3>
            <hr class="mx-6">
        </div>
        {{-- Editor --}}
        <div class="mx-20 pt-6" >
            <div class="border rounded p-4">
                <div>
                    <h3 class="text-[18px] font-semibold  text-gray-600">Editar Nosotros</h3>
                </div>
                <hr class="my-3">
                
                <form method="POST" action="{{ route('adm.nosotros-update') }}" enctype="multipart/form-data"   @submit.prevent="handleSubmit">
                    @csrf
                    <input type="hidden" name="nosotro_id" value="{{ $nosotro->id ?? '' }}">

                    <div>
                        <div class="mb-4">
                            <label class="form-label  text-gray-700 font-medium mb-2" for="">Video (recomendado 1224x688)</label>
                            @if (!empty($nosotro->video))
                                <video autoplay loop muted playsinline  class="mb-3 mt-2 w-full max-w-[1224px] h-[688px] object-cover mx-auto">
                                    <source src="{{ $nosotro->video }}" type="video/mp4">
                                    Tu navegador no soporta el video.
                                </video>
                            @endif  
                            <input type="file" name="video" class="form-control" accept="video/*" id="video"/>
                        </div>

                        <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="foto">Foto (recomendado 600x722)</label>

                            @if (!empty($nosotro->foto))
                                <img :src="foto.foto || '{{ $nosotro->foto }}'" alt="Foto" class="mb-3 w-full max-w-[200px] max-h-[160px] object-cover">
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
                            
                            {{-- Editor Quill --}}
                            <div class="quill-editor bg-white" data-field="descripcion" style="height: 200px;">
                                {!! $nosotro->descripcion ?? '' !!}
                            </div>
                            
                            {{-- Campo oculto para enviar el contenido --}}
                            <input type="hidden" name="descripcion" id="descripcion">
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

                        {{-- Logo 1 --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="foto">Logo 1 (recomendado 50x50)</label>
                            @if (!empty($nosotro->icono1))
                                <img :src="foto.icono1 || '{{ $nosotro->icono1 }}'" alt="Foto"  class="mb-3 w-full max-w-[50px] h-[50px] object-cover">
                            @endif
                            <input type="file" name="icono1" id="icono1" @change="subirFoto"
                                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Titulo logo 1</label>
                            <input type="text" id="nombre_icono1" name="nombre_icono1" placeholder="Texto" value="{{ $nosotro->nombre_icono1 ?? '' }}"
                                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Texto logo 1</label>
                            <div class="quill-editor bg-white" data-field="texto_icono1" style="height: 150px;">
                                {!! $nosotro->texto_icono1 ?? '' !!}
                            </div>
                            <input type="hidden" name="texto_icono1">
                        </div>

                        {{-- Logo 2 --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="foto">Logo 2 (recomendado 50x50)</label>
                            @if (!empty($nosotro->icono2))
                                <img :src="foto.icono2 || '{{ $nosotro->icono2 }}'" alt="Foto"  class="mb-3 w-full max-w-[50px] h-[50px] object-cover">
                            @endif
                            <input type="file" name="icono2" id="icono2" @change="subirFoto"
                                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Titulo logo 2</label>
                            <input type="text" id="nombre_icono2" name="nombre_icono2" placeholder="Texto" value="{{ $nosotro->nombre_icono2 ?? '' }}"
                                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Texto logo 2</label>
                            <div class="quill-editor bg-white" data-field="texto_icono2" style="height: 150px;">
                                {!! $nosotro->texto_icono2 ?? '' !!}
                            </div>
                            <input type="hidden" name="texto_icono2">
                        </div>

                        {{-- Logo 3 --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="foto">Logo 3 (recomendado 50x50)</label>
                            @if (!empty($nosotro->icono3))
                                <img :src="foto.icono3 || '{{ $nosotro->icono3 }}'" alt="Foto"  class="mb-3 w-full max-w-[50px] h-[50px] object-cover">
                            @endif
                            <input type="file" name="icono3" id="icono3" @change="subirFoto"
                                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Titulo logo 3</label>
                            <input type="text" id="nombre_icono3" name="nombre_icono3" placeholder="Texto" value="{{ $nosotro->nombre_icono3 ?? '' }}"
                                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Texto logo 3</label>
                            <div class="quill-editor bg-white" data-field="texto_icono3" style="height: 150px;">
                                {!! $nosotro->texto_icono3 ?? '' !!}
                            </div>
                            <input type="hidden" name="texto_icono3">
                        </div>
                    </div>
                    <button type="submit" class="border rounded p-4">Actualizar</button>
                </form>
            </div>            
        </div>
</div>
    @endsection
@push('scripts')
@include('includes.quill-init')
@endpush