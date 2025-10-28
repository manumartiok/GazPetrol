@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

 {{-- cabezal  --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Clientes</h3>
        <hr class="mx-6">
    </div>
    {{-- Editor --}}
   <div class="p-4">
        <div class="overflow-x-auto rounded-2xl shadow">
            <div class="flex justify-end px-6 py-3 border rounded">
                <a href="{{route('adm.clientes-creador')}}" class="hover:text-gray-400 hover:scale-105 transition-transform duration-300"><i class="fa-solid fa-plus"></i></a>
            </div>
            <table class="min-w-full border border-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr class="text-gray-700 text-sm uppercase">
                <th class="px-4 py-3 text-left">Orden</th>
                <th class="px-4 py-3 text-left">Foto</th>
                <th class="px-4 py-3 text-left">Titulo</th>
                <th class="px-4 py-3 text-center">Activo</th>
                <th class="px-4 py-3 text-center">Acciones</th>
                <th class="px-4 py-3 text-center">Destacado</th>
                </tr>
            </thead>

            <tbody id="galeria-fotos" class="text-gray-600">
                @foreach($cliente as $cliente)
                <tr class="border-t hover:bg-gray-50 cursor-move" data-id="{{$cliente->id}}">
                    <td class="px-4 py-3">{{$cliente->orden}}</td>
                    <td class="px-4 py-3">
                        @if ($cliente->foto)
                            <img src="{{ asset($cliente->foto) }}" alt="Foto" style="max-width:300px; max-height:200px;">
                        @else
                            <p>No hay imagen disponible.</p>
                        @endif
                    </td>
                    <td class="px-4 py-3 w-64 max-w-64 truncate">{{$cliente->texto}}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($cliente->active)
                            <a href="{{ route('adm.clientes-switch', $cliente->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                Activo
                            </a>
                        @else
                            <a href="{{ route('adm.clientes-switch', $cliente->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                Inactivo
                            </a>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center space-x-2 font-bold">
                        <a href="{{ route('adm.clientes-editor', $cliente->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <span>|</span>
                        <a href="{{ route('adm.clientes-destroy', $cliente->id) }}" class="text-red-600 hover:underline">Borrar</a>
                    </td>
                    <td class="px-4 py-3 text-center space-x-2">
                        @if ($cliente->destacado)
                            <a href="{{ route('adm.clientes-destacado', $cliente->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                Destacado
                            </a>
                        @else
                            <a href="{{ route('adm.clientes-destacado', $cliente->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                No destacado
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>  
            </table>
        </div>
    </div>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            activarOrdenDragDrop('#galeria-fotos', '{{ route('adm.clientes-reordenar') }}');
        });
</script>
@endsection