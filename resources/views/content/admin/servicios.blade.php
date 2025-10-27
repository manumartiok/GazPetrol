@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div>
    <h3>Servicios</h3>
    <hr class="mx-6">
</div>

<div class="p-4">
    <div class="overflow-x-auto rounded-2xl shadow">
        <div class="flex justify-end px-6 py-3 border rounded">
            <a href="{{ route('adm.servicios-creador') }}" class="hover:text-gray-400 hover:scale-105 transition-transform duration-300">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <table class="min-w-full border border-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr class="text-gray-700 text-sm uppercase">
                    <th class="px-4 py-3 text-left">Orden</th>
                    <th class="px-4 py-3 text-left">Nombre</th>
                    <th class="px-4 py-3 text-center">Activo</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="servicios-tabla" class="text-gray-600">
                @foreach($servicios as $servicio)
                <tr class="border-t hover:bg-gray-50 cursor-move" data-id="{{ $servicio->id }}">
                    <td class="px-4 py-3">{{ $servicio->orden }}</td>
                    <td class="px-4 py-3 w-64 max-w-64 truncate">{{ $servicio->nombre }}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($servicio->active)
                            <a href="{{ route('adm.servicios-switch', $servicio->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                Activo
                            </a>
                        @else
                            <a href="{{ route('adm.servicios-switch', $servicio->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                Inactivo
                            </a>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center space-x-2 font-bold">
                        <a href="{{ route('adm.servicios-editor', $servicio->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <span>|</span>
                        <a href="{{ route('adm.servicios-destroy', $servicio->id) }}" class="text-red-600 hover:underline">Borrar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        activarOrdenDragDrop('#servicios-tabla', '{{ route('adm.servicios-reordenar') }}');
    });
</script>

@endsection