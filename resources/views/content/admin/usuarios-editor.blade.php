@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar Usuarios</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar usuario</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.usuarios-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="usuarios_id" value="{{ $usuario->id ?? '' }}">

                <div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario" placeholder="Usuario" value="{{ $usuario->usuario ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" value="{{ $usuario->email ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="contraseña">Nueva contraseña</label>
                        <input type="contraseña" id="contraseña" name="contraseña" placeholder="Nueva contraseña"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="password_confirmation">Repetir nueva contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repetir nueva contraseña"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="rol">Rol</label>
                        <select name="rol" id="rol"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            
                            <option value="" disabled {{ empty($usuario->rol) ? 'selected' : '' }}>Seleccionar rol</option>
                            <option value="Administrador" {{ ($usuario->rol ?? '') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Usuario" {{ ($usuario->rol ?? '') == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection