@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   
   {{-- cabezal  --}}
    <div>
        <h3>Metadatos</h3>
        <hr class="mx-6">
    </div>
    {{-- Editor --}}
   <div class="p-4">
        <div class="overflow-x-auto rounded-2xl shadow">
            <div class="flex justify-end px-6 py-3 border rounded">
                <a href="{{route('adm.metadatos-creador')}}" class="hover:text-gray-400 hover:scale-105 transition-transform duration-300"><i class="fa-solid fa-plus"></i></a>
            </div>
            <table class="min-w-full border border-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr class="text-gray-700 text-sm uppercase">
                <th class="px-4 py-3 text-left">Seccion</th>
                <th class="px-10 py-3 text-left">Keywords</th>
                <th class="px-10 py-3 text-left">Descripcion</th>
                <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody class="text-gray-600">
                @foreach($metadato as $metadato)
                <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">{{$metadato->seccion}}</td>
                <td class="px-10 py-3">{{$metadato->keywords}}</td>
                <td class="px-10 py-3">{{$metadato->descripcion}}</td>
                <td class="px-4 py-3 text-center space-x-2 font-bold">
                    <a href="{{ route('adm.metadatos-editor', $metadato->id) }}" class="text-blue-600 hover:underline">Editar</a>
                    <span>|</span>
                    <a href="{{ route('adm.metadatos-destroy', $metadato->id) }}" class="text-red-600 hover:underline">Borrar</a>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@endsection