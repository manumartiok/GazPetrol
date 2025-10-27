@php
       $solicitudes_ban = App\Models\SolicitudBanner::first(); 
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
    <h2 class="text-[22px] font-semibold mb-6">Datos de contacto</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
        @csrf

        {{-- Fila 1 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="nombre" class="text-[13px] font-normal">Nombre y Apellido*</label>
                <input type="text" id="nombre" name="nombre" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="email" class="text-[13px] font-normal">Email*</label>
                <input type="email" id="email" name="email" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
        </div>

        {{-- Fila 2 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="telefono" class="text-[13px] font-normal">Teléfono*</label>
                <input type="text" id="telefono" name="telefono" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="empresa" class="text-[13px] font-normal">Empresa*</label>
                <input type="text" id="empresa" name="empresa" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
        </div>

        {{-- Consulta --}}
        <h2 class="text-[22px] font-semibold mt-4">Consulta</h2>

        {{-- Fila 3 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="producto" class="text-[13px] font-normal">Producto*</label>
                <select id="producto" name="producto" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none appearance-none bg-white">
                    <option value="">Seleccionar producto</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="servicio" class="text-[13px] font-normal">Servicio*</label>
                <select id="servicio" name="servicio" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none appearance-none bg-white">
                    <option value="">Seleccionar servicio</option>
                </select>
            </div>
        </div>

        {{-- Fila 4 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="aplicacion" class="text-[13px] font-normal">Aplicación*</label>
                <select id="aplicacion" name="aplicacion" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none appearance-none bg-white">
                    <option value="">Seleccionar aplicación</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="archivo" class="text-[13px] font-normal">Adjuntar archivo</label>
                <input type="file" id="archivo" name="archivo" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 file:hidden focus:outline-none">
            </div>
        </div>

        {{-- Fila 5 (Aclaraciones + botón) --}}
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="aclaraciones" class="text-[13px] font-normal">Aclaraciones / Observaciones</label>
                <textarea id="aclaraciones" name="aclaraciones" rows="5" class="border border-[#DCDCDC] rounded-[10px] px-4 py-2 focus:outline-none resize-none"></textarea>
            </div>
            <div class="w-full md:w-1/2 flex flex-col justify-between gap-4">
                <p class="text-[13px] text-[#5C5C5C] mt-[10px]">*Datos obligatorios</p>
                <button type="submit" class="self-end w-full md:w-[250px] h-[40px] bg-[#0A3858] text-white rounded-full text-[13px] hover:bg-[#082a45] transition">
                    Solicitar presupuesto
                </button>
            </div>
        </div>
    </form>
</div>
@endsection