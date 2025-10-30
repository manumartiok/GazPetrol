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
                    <th class="px-4 py-3 text-center" style="width:25%;">Nombre</th>
                    <th class="px-4 py-3 text-center" style="width:0%;">Foto</th>
                    <th class="px-4 py-3 text-center" style="width:20%;">Activo</th>
                    <th class="px-4 py-3 text-center" style="width:10%;">Acciones</th>
                </tr>
            </thead>

            <tbody id="galeria-fotos" class="text-gray-600">
                @foreach($categorias as $catIndex => $categoria)
                    {{-- Encabezado de categoría --}}
                    <tr class="bg-gray-200 font-bold text-center no-ordena">
                        <td colspan="6" class="px-4 py-2 text-gray-700">
                            {{ $categoria->categoria ?? 'Sin categoría' }}
                        </td>
                    </tr>

                    {{-- Productos de esta categoría --}}
                    @foreach($categoria->productos as $prodIndex => $producto)
                        <tr class="border-t hover:bg-gray-50 product-row cursor-move"
                            data-id="{{ $producto->id }}"
                            data-cat-index="{{ $catIndex }}"
                            data-prod-index="{{ $prodIndex }}">
                            <td class="px-4 py-3 text-center orden-celda">{{$producto->orden}}</td>
                            <td class="px-4 py-3 w-64 max-w-64 truncate text-center nombre-producto">{{$producto->nombre}}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($producto->foto_producto)
                                    <img src="{{ asset($producto->foto_producto) }}" alt="Foto" style="max-width:300px; max-height:200px;">
                                @else
                                    <p>No hay imagen disponible.</p>
                                @endif
                            </td>
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
function filtrarProductos() {
    const filtro = document.getElementById('buscador').value.toLowerCase();
    const filas = document.querySelectorAll('#galeria-fotos tr.product-row');

    filas.forEach(fila => {
        const nombre = fila.querySelector('.nombre-producto').textContent.toLowerCase();
        fila.style.display = nombre.includes(filtro) ? 'table-row' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const tbody = document.querySelector('#galeria-fotos');
    if (!tbody) return;

    Sortable.create(tbody, {
        animation: 150,
        handle: '.cursor-move',
        draggable: 'tr',
        filter: '.no-ordena',
        onEnd: function () {
            const filas = Array.from(tbody.querySelectorAll('tr.product-row'));
            const grupos = {};
            const orden = [];

            // Agrupar productos por categoría
            filas.forEach(fila => {
                const catIndex = parseInt(fila.dataset.catIndex, 10);
                if (!grupos[catIndex]) grupos[catIndex] = [];
                grupos[catIndex].push(fila);
            });

            // Asignar orden por categoría
            Object.keys(grupos).sort().forEach((catIndex, catPos) => {
                const prefix = String.fromCharCode(65 + catPos); // A, B, C según categoría
                grupos[catIndex].forEach((fila, prodIndex) => {
                    const suffix = String.fromCharCode(65 + prodIndex); // A, B, C según posición
                    const newOrder = prefix + suffix; // AA, AB, AC o BA, BB, BC

                    // Actualizar celda de orden
                    const celdaOrden = fila.querySelector('.orden-celda');
                    if (celdaOrden) celdaOrden.textContent = newOrder;

                    // Agregar al array de actualización
                    orden.push({
                        id: fila.dataset.id,
                        orden: newOrder
                    });
                });
            });

            // Enviar actualización al servidor
            fetch('{{ route('adm.productos-reordenar') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ orden })
            })
            .then(r => r.json())
            .then(() => console.log('Orden actualizado correctamente'))
            .catch(err => console.error('Error al actualizar el orden:', err));
        }
    });
});
</script>

@endsection