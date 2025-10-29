@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

{{-- cabezal --}}
<div>
    <h3 class="text-[20px] font-bold text-gray-500">Editar Productos</h3>
    <hr class="mx-6">
</div>

{{-- Editor --}}
<div class="mx-20 pt-6" id="app">
    <div class="border border-rounded p-4">
        <div>
            <h3 class="text-[18px] font-semibold text-gray-600">Editar producto</h3>
        </div>
        <hr class="my-3">

        <form method="POST" action="{{ route('adm.productos-update') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit">
            @csrf
            <input type="hidden" name="productos_id" value="{{ $producto->id ?? '' }}">

            <div>
                {{-- Foto producto --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto_producto">Foto (recomendado 287x287)</label>

                    @if (!empty($producto->foto_producto))
                        <img :src="foto.foto_producto || '{{ $producto->foto_producto }}'" alt="Foto" class="mb-3 w-full max-w-[287px] h-[287px] object-cover">
                    @endif

                    <input type="file" name="foto_producto" id="foto_producto" @change="subirFoto"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>

                {{-- Categoría --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categoria as $cat)
                            <option value="{{ $cat->id }}" {{ (isset($producto->categoria_id) && $producto->categoria_id == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Orden --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                    <input type="text" id="orden" name="orden" placeholder="Orden" value="{{ $producto->orden ?? '' }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Nombre --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="{{ $producto->nombre ?? '' }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Detalle --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="detalle">Detalle</label>
                    <div class="quill-editor bg-white" data-field="detalle" style="height: 150px;">
                        {!! $producto->detalle ?? '' !!}
                    </div>
                    <input type="hidden" name="detalle" id="detalle">
                </div>

                {{-- Ficha técnica --}}
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="ficha_tecnica">Ficha Técnica</label>

                    <div id="ficha-tecnica-container">
                        @if (!empty($producto->ficha_tecnica))
                            <div class="mb-3 p-3 bg-gray-50 rounded border border-gray-200">
                                <a href="{{ asset($producto->ficha_tecnica) }}" target="_blank" class="text-blue-600 hover:underline mb-1 inline-block">
                                    Ver ficha técnica actual
                                </a>
                                <p class="text-gray-700 mb-2">
                                    Archivo: <span class="font-medium">{{ basename($producto->ficha_tecnica) }}</span>
                                </p>
                                <button type="button" class="btn-eliminar-ficha bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-medium transition"
                                    data-url="{{ route('adm.productos-ficha-destroy', $producto->id) }}">
                                    Eliminar Ficha Técnica
                                </button>
                            </div>
                        @endif
                    </div>

                    <input type="file" name="ficha_tecnica" id="ficha_tecnica"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>

                <button type="submit" class="border rounded p-4">Actualizar</button>
            </div>
        </form>

        <hr class="my-10">

        {{-- Formulario de galería --}}
        <form id="form-galeria" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="productos_id" value="{{ $producto->id ?? '' }}">

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="fotos">
                    Galería (recomendado 392x380) - Puedes seleccionar múltiples fotos
                </label>
                <input type="file" name="fotos[]" id="fotos" multiple accept="image/*"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required/>
                <p class="text-sm text-gray-500 mt-1" id="file-count">No hay archivos seleccionados</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="orden_galeria">Orden inicial</label>
                <input type="number" id="orden_galeria" name="orden" placeholder="Orden" value="0"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Las siguientes fotos tendrán orden consecutivo</p>
            </div>

            <button type="submit" id="btn-subir-fotos" class="border rounded p-4">
                Agregar Fotos
            </button>
            <span id="loading-galeria" class="ml-3 text-gray-600 hidden">
                <svg class="animate-spin h-5 w-5 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Subiendo...
            </span>
        </form>

        {{-- Mensaje de éxito --}}
        <div id="mensaje-exito" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded"></div>

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
                                <a href="{{ route('adm.productos-fotos-switch', $foto->id) }}" class="badge {{ $foto->active ? 'bg-green-400' : 'bg-red-400' }} text-white px-4 py-2 rounded">
                                    {{ $foto->active ? 'Activo' : 'Inactivo' }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2 font-bold">
                                <a href="{{ route('adm.productos-fotos-destroy', $foto->id) }}" class="btn-borrar text-red-600 hover:underline" data-id="{{ $foto->id }}">Borrar</a>
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
    // -----------------------------
    // Drag & Drop
    activarOrdenDragDrop('#galeria-fotos', '{{ route('adm.productos-fotos-reordenar') }}');

    // -----------------------------
    // Contador de archivos seleccionados
    const inputFotos = document.getElementById('fotos');
    const fileCount = document.getElementById('file-count');
    inputFotos.addEventListener('change', function() {
        const count = this.files.length;
        fileCount.textContent = count === 0 ? 'No hay archivos seleccionados' :
                                count === 1 ? '1 archivo seleccionado' :
                                count + ' archivos seleccionados';
    });

    // -----------------------------
    // Mensaje de éxito
    const mensajeExito = document.getElementById('mensaje-exito');

    // -----------------------------
    // Subida de fotos
    const formGaleria = document.getElementById('form-galeria');
    const btnSubmit = document.getElementById('btn-subir-fotos');
    const loading = document.getElementById('loading-galeria');
    const galeriaFotos = document.getElementById('galeria-fotos');

    formGaleria.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        btnSubmit.disabled = true;
        loading.classList.remove('hidden');
        mensajeExito.classList.add('hidden');

        fetch('{{ route('adm.productos-fotos-store') }}', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                mensajeExito.textContent = data.message;
                mensajeExito.classList.remove('hidden');

                data.fotos.forEach(foto => {
                    const newRow = `
                        <tr class="border-t hover:bg-gray-50 cursor-move" data-id="${foto.id}">
                            <td class="px-4 py-3">${foto.orden}</td>
                            <td class="px-4 py-3"><img src="${foto.foto}" style="max-width:200px; max-height:150px;"></td>
                            <td class="px-4 py-3 text-center">
                                <a href="${foto.switch_url}" class="badge ${foto.active ? 'bg-green-400' : 'bg-red-400'} text-white px-4 py-2 rounded">
                                    ${foto.active ? 'Activo' : 'Inactivo'}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2 font-bold">
                                <a href="${foto.destroy_url}" class="btn-borrar text-red-600 hover:underline" data-id="${foto.id}">Borrar</a>
                            </td>
                        </tr>`;
                    galeriaFotos.insertAdjacentHTML('beforeend', newRow);
                });

                formGaleria.reset();
                fileCount.textContent = 'No hay archivos seleccionados';

                setTimeout(() => mensajeExito.classList.add('hidden'), 5000);
                activarOrdenDragDrop('#galeria-fotos', '{{ route('adm.productos-fotos-reordenar') }}');
                activarBorrado();
            }
        })
        .catch(err => alert('Hubo un error al subir las fotos.'))
        .finally(() => { btnSubmit.disabled = false; loading.classList.add('hidden'); });
    });

    // -----------------------------
    // Función para borrar fotos y ficha técnica
    function activarBorrado() {
        // Fotos
        document.querySelectorAll('.btn-borrar').forEach(btn => {
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);

            newBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (!confirm('¿Deseas eliminar esta foto?')) return;

                const url = this.getAttribute('href');
                const row = this.closest('tr');

                fetch(url, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        row.style.transition = 'opacity 0.3s';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 300);

                        mensajeExito.textContent = data.message;
                        mensajeExito.classList.remove('hidden');
                        setTimeout(() => mensajeExito.classList.add('hidden'), 3000);
                    } else alert(data.message || 'Error al eliminar la foto');
                });
            });
        });

        // Ficha técnica
        document.querySelectorAll('.btn-eliminar-ficha').forEach(btn => {
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);

            newBtn.addEventListener('click', function() {
                if (!confirm('¿Deseas eliminar la ficha técnica?')) return;

                const url = this.getAttribute('data-url');
                const container = document.getElementById('ficha-tecnica-container');

                fetch(url, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        container.style.transition = 'opacity 0.5s, transform 0.5s';
                        container.style.opacity = '0';
                        container.style.transform = 'translateY(-20px)';
                        setTimeout(() => container.remove(), 500);

                        mensajeExito.textContent = data.message;
                        mensajeExito.classList.remove('hidden');
                        setTimeout(() => mensajeExito.classList.add('hidden'), 3000);
                    } else alert(data.message || 'Error al eliminar la ficha técnica');
                });
            });
        });
    }

    activarBorrado();
});
</script>

@endsection

@push('scripts')
    @include('includes.quill-init')
@endpush