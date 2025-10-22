@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

 {{-- cabezal  --}}
    <div>
        <h3>Institucional</h3>
        <hr class="mx-6">
    </div>
    {{-- Editor --}}
   <div class="p-4">
        <div class="overflow-x-auto rounded-2xl shadow">
            <div class="flex justify-end px-6 py-3 border rounded">
                <a href="{{route('adm.institucional-creador')}}" class="hover:text-gray-400 hover:scale-105 transition-transform duration-300"><i class="fa-solid fa-plus"></i></a>
            </div>
            <table class="min-w-full border border-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr class="text-gray-700 text-sm uppercase">
                <th class="px-4 py-3 text-left">Orden</th>
                <th class="px-4 py-3 text-left">Foto</th>
                <th class="px-4 py-3 text-left">Titulo</th>
                <th class="px-4 py-3 text-left">Texto</th>
                <th class="px-4 py-3 text-center">Activo</th>
                <th class="px-4 py-3 text-center">Acciones</th>
                <th class="px-4 py-3 text-center">Destacado</th>
                </tr>
            </thead>

            <tbody class="text-gray-600">
                @foreach($institucional as $institucional)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{$institucional->orden}}</td>
                    <td class="px-4 py-3">
                        @if ($institucional->foto)
                            <img src="{{ asset($institucional->foto) }}" alt="Foto" style="max-width:300px; max-height:200px;">
                        @else
                            <p>No hay imagen disponible.</p>
                        @endif
                    </td>
                    <td class="px-4 py-3 w-64 max-w-64 truncate">{{$institucional->titulo}}</td>
                    <td class="px-4 py-3 w-64 max-w-64 truncate">{{$institucional->texto}}</td>
                    <td class="px-4 py-3 text-center">
                        @if ($institucional->active)
                            <a href="{{ route('adm.institucional-switch', $institucional->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                Activo
                            </a>
                        @else
                            <a href="{{ route('adm.institucional-switch', $institucional->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                Inactivo
                            </a>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center space-x-2 font-bold">
                        <a href="{{ route('adm.institucional-editor', $institucional->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <span>|</span>
                        <a href="{{ route('adm.institucional-destroy', $institucional->id) }}" class="text-red-600 hover:underline">Borrar</a>
                    </td>
                    <td class="px-4 py-3 text-center space-x-2">
                        @if ($institucional->destacado)
                            <a href="{{ route('adm.institucional-destacado', $institucional->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                Destacado
                            </a>
                        @else
                            <a href="{{ route('adm.institucional-destacado', $institucional->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
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
@endsection