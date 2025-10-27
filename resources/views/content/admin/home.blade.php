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
            
            <form method="POST" action="{{ route('adm.home-update') }}" enctype="multipart/form-data " @submit.prevent="handleSubmit">
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
                        <label class="block text-gray-700 font-medium mb-2">Descripcion</label>
                        
                        {{-- Editor Quill --}}
                        <div class="quill-editor bg-white" data-field="descripcion" style="height: 200px;">
                            {!! $home->descripcion ?? '' !!}
                        </div>
                        
                        {{-- Campo oculto para enviar el contenido --}}
                        <input type="hidden" name="descripcion" id="descripcion">
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

@push('scripts')
<script>
    setTimeout(function() {
        if (typeof Quill === 'undefined') {
            console.error('ERROR: Quill no está cargado');
            return;
        }

        const toolbarConfig = [
            ['bold', 'italic', 'underline'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'size': ['small', false, 'large', 'huge'] }],
            [{ 'align': [] }],
            ['clean']
        ];

        const editores = [];

        document.querySelectorAll('.quill-editor').forEach(function(container) {
            const fieldName = container.dataset.field;
            
            const quill = new Quill(container, {
                theme: 'snow',
                modules: { toolbar: toolbarConfig },
                placeholder: 'Escribe aquí...'
            });

            editores.push({
                quill: quill,
                fieldName: fieldName
            });
            
            console.log('✓ Editor', fieldName, 'inicializado');
        });

        console.log('✓ Total de editores inicializados:', editores.length);

        // Exponer función para Vue
        window.guardarContenidoQuill = function() {
            let contador = 0;
            
            editores.forEach(function(editor) {
                let contenido = editor.quill.root.innerHTML;
                
                if (contenido === '<p><br></p>' || contenido.trim() === '') {
                    contenido = ' ';
                }
                
                const input = document.querySelector('input[name="' + editor.fieldName + '"]');
                if (input) {
                    input.value = contenido;
                    contador++;
                    console.log('✓ Guardado', editor.fieldName, ':', contenido.substring(0, 30) + '...');
                }
            });
            
            console.log('✓ Total editores guardados:', contador);
            return true;
        };
        
    }, 1000);
</script>
@endpush