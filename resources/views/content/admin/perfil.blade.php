@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="mx-20" id="app">
    <h1 class="mb-4">Perfil</h1>
    <div class="border border-rounded p-4">
        <h3>Detalles del perfil</h3>
        <hr class="my-3">

        <form method="POST" action="{{ route('adm.perfil-update') }}" enctype="multipart/form-data">
            @csrf

            {{-- Datos básicos --}}
            <div class="flex w-full gap-20">
                <div class="mb-4 w-1/2">
                    <label class="block text-gray-700 font-medium mb-2">Usuario</label>
                    <input type="text" name="usuario" value="{{ $usuario->usuario }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4 w-1/2">
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ $usuario->email }}"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <hr class="my-3">

            {{-- Contraseña --}}
            <div class="mb-4">
                <h3>Actualizar contraseña</h3>
            </div>

            <div class="flex w-full gap-20">
                <div class="mb-4 w-1/2">
                    <label class="block text-gray-700 font-medium mb-2">Nueva contraseña</label>
                    <input type="password" name="contraseña"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4 w-1/2">
                    <label class="block text-gray-700 font-medium mb-2">Confirmar contraseña</label>
                    <input type="password" name="contraseña_confirmation"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <hr class="my-4">

            <button type="submit" class="border rounded px-6 py-2 bg-blue-600 text-white hover:bg-blue-700 transition">
                Actualizar
            </button>
        </form>
    </div>
</div>

@endsection