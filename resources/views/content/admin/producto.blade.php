@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

{{-- cabezal  --}}
<div>
    <h3 class="text-[20px] font-bold text-gray-500">Producto</h3>
    <hr class="mx-6">
</div>

{{-- Editor --}}
<div class="p-4">
    <div class="overflow-x-auto rounded-2xl shadow">

        {{-- Barra superior con buscador y botón --}}
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 px-6 py-3 border rounded">
            {{-- Buscador --}}
            <div class="relative w-full sm:w-1/2">
                <input type="text" id="buscador" placeholder="Buscar producto..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    onkeyup="filtrarProductos()">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400"></i>
            </div>

            {{-- Botón agregar --}}
            <a href="{{ route('adm.productos-creador') }}"
               class="hover:text-gray-400 hover:scale-105 transition-transform duration-300 text-xl">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>

        {{-- Tabla --}}
        <table class="min-w-full border border-gray-200 bg-white mt-3" style="table-layout: fixed;">
            <thead class="bg-gray-100">
                <tr class="text-gray-700 text-sm uppercase">
                    <th class="px-4 py-3 text-center" style="width:10%;">Orden</th>
                    <th class="px-4 py-3 text-center" style="width:20%;">Nombre</th>
                    <th class="px-4 py-3 text-center" style="width:20%;">Foto</th>
                    <th class="px-4 py-3 text-center" style="width:30%;">Detalle</th>
                    <th class="px-4 py-3 text-center" style="width:10%;">Activo</th>
                    <th class="px-4 py-3 text-center" style="width:10%;">Acciones</th>
                </tr>
            </thead>

            <tbody id="galeria-fotos" class="text-gray-600">
                @php $index = 0; @endphp
                @foreach($producto->groupBy(fn($p) => $p->categoria->categoria ?? 'Sin categoría') as $categoriaNombre => $productos)
                    @php $index++; $groupId = 'grupo_' . $index; @endphp

                    {{-- Encabezado clickeable --}}
                    <tr class="bg-light cursor-pointer no-ordena" onclick="toggleGrupo('{{ $groupId }}')">
                        <td colspan="6" class="px-4 py-3"><strong>{{ $categoriaNombre }}</strong></td>
                    </tr>

                    {{-- Productos ocultos inicialmente --}}
                    @foreach($productos as $producto)
                        <tr class="border-t hover:bg-gray-50 grupo-producto {{ $groupId }} cursor-move"
                            style="display: none;" data-id="{{$producto->id}}">
                            <td class="px-4 py-3 text-center">{{$producto->orden}}</td>
                            <td class="px-4 py-3 w-64 max-w-64 truncate text-center nombre-producto">{{$producto->nombre}}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($producto->foto_producto)
                                    <img src="{{ asset($producto->foto_producto) }}" alt="Foto" style="max-width:300px; max-height:200px;">
                                @else
                                    <p>No hay imagen disponible.</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 w-64 max-w-64 overflow-hidden text-center" style="max-height: 3.6em;">{!!$producto->detalle!!}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($producto->active)
                                    <a href="{{ route('adm.productos-switch', $producto->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                        Activo
                                    </a>
                                @else
                                    <a href="{{ route('adm.productos-switch', $producto->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                        Inactivo
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-2 font-bold">
                                <a href="{{ route('adm.productos-editor', $producto->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                <span>|</span>
                                <a href="{{ route('adm.productos-destroy', $producto->id) }}" class="text-red-600 hover:underline">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>  
        </table>
    </div>
</div>

<script>
function toggleGrupo(groupClass) {
    const rows = document.querySelectorAll('.' + groupClass);
    rows.forEach(row => {
        row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
    });
}

// Buscador de productos
function filtrarProductos() {
    const input = document.getElementById('buscador');
    const filtro = input.value.toLowerCase();
    const filas = document.querySelectorAll('.grupo-producto');

    filas.forEach(fila => {
        const nombre = fila.querySelector('.nombre-producto').textContent.toLowerCase();
        fila.style.display = nombre.includes(filtro) ? 'table-row' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    activarOrdenDragDrop('#galeria-fotos', '{{ route('adm.productos-reordenar') }}');
});
</script>

@endsection