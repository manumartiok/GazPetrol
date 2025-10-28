@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

{{-- cabezal  --}}
<div>
    <h3 class="text-[20px] font-bold text-gray-500">Usuarios</h3>
    <hr class="mx-6">
</div>

{{-- Editor --}}
<div class="p-4">
    <div class="overflow-x-auto rounded-2xl shadow">
        <div class="flex justify-end px-6 py-3 border rounded">
            {{-- Solo mostrar botón de crear si es administrador --}}
            @if(Auth::user()->rol === 'Administrador')
                <a href="{{route('adm.usuarios-creador')}}" class="hover:text-gray-400 hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-plus"></i>
                </a>
            @endif
        </div>
        
        <table class="min-w-full border border-gray-200 bg-white">
        <thead class="bg-gray-100">
            <tr class="text-gray-700 text-sm uppercase">
                <th class="px-4 py-3 text-left">Usuario</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Rol</th>
                <th class="px-4 py-3 text-center">Activo</th>
                <th class="px-4 py-3 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody class="text-gray-600">
            @foreach($usuario as $usuario)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">{{$usuario->usuario}}</td>
                <td class="px-4 py-3">{{$usuario->email}}</td>
                <td class="px-4 py-3 w-64 max-w-64 truncate">{{$usuario->rol}}</td>
                
                <td class="px-4 py-3 text-center">
                    {{-- Solo administrador puede cambiar estado --}}
                    @if(Auth::user()->rol === 'Administrador')
                        @if ($usuario->active)
                            <a href="{{ route('adm.usuarios-switch', $usuario->id) }}" class="badge bg-green-400 text-white px-4 py-2 rounded">
                                Activo
                            </a>
                        @else
                            <a href="{{ route('adm.usuarios-switch', $usuario->id) }}" class="badge bg-red-400 text-white px-4 py-2 rounded">
                                Inactivo
                            </a>
                        @endif
                    @else
                        {{-- Solo mostrar estado sin enlace --}}
                        <span class="badge {{ $usuario->active ? 'bg-green-400' : 'bg-red-400' }} text-white px-4 py-2 rounded">
                            {{ $usuario->active ? 'Activo' : 'Inactivo' }}
                        </span>
                    @endif
                </td>

                <td class="px-4 py-3 text-center space-x-2 font-bold">
                    {{-- Solo administrador puede editar o borrar --}}
                    @if(Auth::user()->rol === 'Administrador')
                        <a href="{{ route('adm.usuarios-editor', $usuario->id) }}" class="text-blue-600 hover:underline">Editar</a>
                        <span>|</span>
                        <a href="{{ route('adm.usuarios-destroy', $usuario->id) }}" class="text-red-600 hover:underline">Borrar</a>
                    @else
                        <span class="text-gray-400">Sin permisos</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection