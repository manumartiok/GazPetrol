@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<div>
    <h3 class="text-[20px] font-bold text-gray-500">Crear Servicio</h3>
    <hr class="mx-6">
</div>

<div class="mx-20 pt-6">
    <div class="border border-rounded p-4">
        <h3>Nuevo servicio</h3>
        <hr class="my-3">
        
        <form method="POST" action="{{ route('adm.servicios-store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                <input type="text" id="orden" name="orden" placeholder="Orden"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="border rounded p-4">Crear</button>
        </form>
    </div>
</div>

@endsection