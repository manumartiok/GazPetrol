@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   
   {{-- cabezal  --}}
    <div>
        <h3>Redes</h3>
        <hr class="mx-6">
    </div>
    {{-- Editor --}}
   <div class="p-4">
        <div class="overflow-x-auto rounded-2xl shadow">
            <div class="flex justify-end px-6 py-3 border rounded">
                <a href="{{route('adm.redes-creador')}}" class="hover:text-gray-400 hover:scale-105 transition-transform duration-300"><i class="fa-solid fa-plus"></i></a>
            </div>
            <table class="min-w-full border border-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr class="text-gray-700 text-sm uppercase">
                <th class="px-4 py-3 text-left">Orden</th>
                <th class="px-4 py-3 text-left">Icono</th>
                <th class="px-4 py-3 text-left">Nombre</th>
                <th class="px-4 py-3 text-center">URL</th>
                <th class="px-4 py-3 text-center">Activo</th>
                <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-gray-600">
                @foreach($red as $red)
                <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">{{$red->orden}}</td>
                <td class="px-4 py-3">  <i class="fa-brands {{$red->icono}} text-xl"></i></td>
                <td class="px-4 py-3 w-64 max-w-64 truncate">{{$red->nombre}}</td>
                <td class="px-4 py-3 w-64 max-w-64 truncate">{{$red->url}}</td>
                <td class="px-4 py-3 text-center">
                    @if ($red->active)
                        <a href="{{ route('adm.redes-switch', $red->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                            Activo
                        </a>
                    @else
                        <a href="{{ route('adm.redes-switch', $red->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                            Inactivo
                        </a>
                    @endif
                </td>
                <td class="px-4 py-3 text-center space-x-2 font-bold">
                    <a href="{{ route('adm.redes-editor', $red->id) }}" class="text-blue-600 hover:underline">Editar</a>
                    <span>|</span>
                    <a href="{{ route('adm.redes-destroy', $red->id) }}" class="text-red-600 hover:underline">Borrar</a>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection