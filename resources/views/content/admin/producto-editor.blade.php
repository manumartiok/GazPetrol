@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar Productos</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar producto</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.productos-update') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                @csrf
                <input type="hidden" name="productos_id" value="{{ $producto->id ?? '' }}">

                <div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="foto_producto">Foto</label>

                        @if (!empty($producto->foto_producto))
                            <img :src="foto.foto_producto || '{{ $producto->foto_producto }}'" alt="Foto" style="width: 20%;" class="mb-3">
                        @endif

                        <input type="file" name="foto_producto" id="foto_producto" @change="subirFoto"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="categoria_id">Categoría</label>
                        <select name="categoria_id" id="categoria_id"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccionar categoría</option>
                            @foreach($categoria as $categoria)
                                <option value="{{ $categoria->id }}" 
                                    {{ (isset($producto->categoria_id) && $producto->categoria_id == $categoria->id) ? 'selected' : '' }}>
                                    {{ $categoria->categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" value="{{ $producto->orden ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{ $producto->nombre ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="detalle">Detalle</label>

                        {{-- 🔽 Editor Quill --}}
                        <div class="quill-editor bg-white" data-field="detalle" style="height: 150px;">
                            {!! $producto->detalle ?? '' !!}
                        </div>

                        {{-- Campo oculto que guarda el HTML del Quill --}}
                        <input type="hidden" name="detalle" id="detalle">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="ficha_tecnica">Ficha Técnica</label>

                        @if (!empty($producto->ficha_tecnica))
                            {{-- Link para abrir la ficha --}}
                            <a href="{{ asset($producto->ficha_tecnica) }}" target="_blank" class="text-blue-600 hover:underline hover:scale-100 mb-1 ">
                                Ver ficha técnica actual
                            </a>

                            {{-- Mostrar nombre del archivo --}}
                            <p class="text-gray-700 mb-2">
                                Archivo: {{ basename($producto->ficha_tecnica) }}
                            </p>
                        @endif

                        <input type="file" name="ficha_tecnica" id="ficha_tecnica"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <button type="submit" class="border rounded p-4">Actualizar</button>
                </div>
            </form>

            <hr class="my-10">

            {{-- Formulario de fotos del producto --}}
            <form method="POST" action="{{ route('adm.productos-fotos-store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="productos_id" value="{{ $producto->id ?? '' }}">

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto">Galería</label>
                    <input type="file" name="foto" id="foto" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                    <input type="text" id="orden" name="orden" placeholder="Orden" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="border rounded p-4">Agregar Foto</button>
            </form>

            {{-- Tabla de fotos --}}
            <div class="p-4 mt-6">
                <div class="overflow-x-auto rounded-2xl shadow">
                    <table class="min-w-full border border-gray-200 bg-white">
                        <thead class="bg-gray-100">
                            <tr class="text-gray-700 text-sm uppercase">
                                <th class="px-4 py-3 text-left">Orden</th>
                                <th class="px-4 py-3 text-left">Imagen</th>
                                <th class="px-4 py-3 text-center">Activo</th>
                                <th class="px-4 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody id="galeria-fotos" class="text-gray-600">
                            @foreach($producto->fotos as $foto)
                            <tr class="border-t hover:bg-gray-50 cursor-move" data-id="{{ $foto->id }}">
                                <td class="px-4 py-3">{{ $foto->orden }}</td>
                                <td class="px-4 py-3">
                                    @if ($foto->foto)
                                        <img src="{{ asset($foto->foto) }}" alt="Foto" style="max-width:200px; max-height:150px;">
                                    @else
                                        <p>No hay imagen disponible.</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if ($foto->active)
                                        <a href="{{ route('adm.productos-fotos-switch', $foto->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                            Activo
                                        </a>
                                    @else
                                        <a href="{{ route('adm.productos-fotos-switch', $foto->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                            Inactivo
                                        </a>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center space-x-2 font-bold">
                                    <a href="{{ route('adm.productos-fotos-destroy', $foto->id) }}" class="text-red-600 hover:underline">Borrar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            activarOrdenDragDrop('#galeria-fotos', '{{ route('adm.productos-fotos-reordenar') }}');
        });
    </script>

@endsection

@push('scripts')
    @include('includes.quill-init')
@endpush