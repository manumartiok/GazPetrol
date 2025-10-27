@php
       $solicitudes_ban = App\Models\SolicitudBanner::first(); 
       $productos = App\Models\Producto::where('active', true)->orderBy('orden')->get();
       $servicios = App\Models\Servicio::where('active', true)->orderBy('orden')->get();
@endphp

@extends('layouts.web')

@section('title', 'Solicitud')

@section('content')

            {{-- banner  --}}

<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $solicitudes_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$solicitudes_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$solicitudes_ban->texto}}</h1>
    </div>
</div>
{{-- contenido --}}
<div class="nunitosans max-w-[1366px] mx-auto px-[73px] lg:px-[173px] py-[80px]">
    
    {{-- Datos de contacto --}}
    <h2 class="text-[32px] font-bold mb-6">Datos de contacto</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
        @csrf

        {{-- Fila 1 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="nombre" class="text-[16px] font-normal">Nombre y Apellido*</label>
                <input type="text" id="nombre" name="nombre" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="email" class="text-[16px] font-normal">Email*</label>
                <input type="email" id="email" name="email" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
        </div>

        {{-- Fila 2 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="telefono" class="text-[16px] font-normal">Teléfono*</label>
                <input type="text" id="telefono" name="telefono" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="empresa" class="text-[16px] font-normal">Empresa*</label>
                <input type="text" id="empresa" name="empresa" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
        </div>

        {{-- Consulta --}}
        <h2 class="text-[32px] font-bold mt-4">Consulta</h2>

        {{-- Fila 3 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="producto" class="text-[16px] font-normal">Producto*</label>
                <select id="producto" name="producto" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none appearance-none bg-white" required>
                    <option value="" >Seleccionar producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                     @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="servicio" class="text-[16px] font-normal">Servicio*</label>
                <select id="servicio" name="servicio" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none appearance-none bg-white" required>
                    <option value="">Seleccionar servicio</option>
                     @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                     @endforeach
                </select>
            </div>
        </div>

        {{-- Fila 4 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2 ">
                <label for="archivo" class="text-[16px] ">Adjuntar archivo</label>
                <input type="file" id="archivo" name="archivo" class="h-[40px] flex pt-[7px] border border-[#DCDCDC] rounded-full cursor-pointer px-4 file:hidden focus:outline-none">
            </div>
        </div>

        {{-- Fila 5 (Aclaraciones + botón) --}}
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="aclaraciones" class="text-[16px] font-normal">Aclaraciones / Observaciones</label>
                <textarea id="aclaraciones" name="aclaraciones" rows="6" class="border border-[#DCDCDC] rounded-[10px] px-4 py-2 focus:outline-none resize-none"></textarea>
            </div>

            <div class="w-full md:w-1/2 flex flex-col mt-auto">
                <div class="flex items-center justify-between gap-4">
                    <h1 class="text-[16px] text-[#5C5C5C]">*Datos obligatorios</h1>
                    <button type="submit" class="w-full md:w-[290px] h-[40px] bg-[#0A3858] text-white rounded-[20px] text-[16px] hover:bg-[#082a45] transition">
                        Solicitar presupuesto
                    </button>
                </div>
            </div>
</div>
    </form>
</div>
@endsection