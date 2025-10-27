@php
    $nosotros_ban = App\Models\NosotroBanner::first();
    $nosotros = App\Models\Nosotro::first(); 
@endphp

@extends('layouts.web')

@section('title', 'Nosotros')

@section('content')

    
{{-- banner  --}}

<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $nosotros_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$nosotros_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$nosotros_ban->texto}}</h1>
    </div>
</div>

{{-- contenido  --}}
<div>
    {{-- nosotros  --}}
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] pt-[100px] pb-[50px] flex flex-col justify-center">
        <div class="flex w-full gap-[34px]">
            {{-- texto  --}}
            <div class="w-1/2">
                <h3 class="text-[16px] font-bold text-[#5FBB46]">{{$nosotros->texto_chico1}}</h3>
                <h1 class="text-[32px] font-bold text-[#0A3858] mb-2">{{$nosotros->texto_grande1}}</h1>
                <h4>{!! $nosotros->descripcion !!}</h4>
            </div>
            {{-- Foto  --}}
            <div class="w-1/2 flex flex-grow">
                <img src="{{$nosotros->foto}}" alt="">
            </div>
        </div>
    </div>
    {{-- valores  --}}
    <div class="h-full w-full bg-[#F5F5F5] mb-[50px] ">
        <div class="nunitosans max-w-[1366px] mx-auto px-[73px] pt-[56px] pb-[115px] flex flex-col">
            {{-- encabezado  --}}
            <div class="flex flex-col">
                <h1 class="text-[16px] font-bold text-[#5FBB46]">{{$nosotros->texto_chico2}}</h1>
                <h2 class="text-[32px] font-bold text-[#0A3858] mb-[24px]">{{$nosotros->texto_grande2}}</h2>
            </div>
            {{-- detalles  --}}
            <div class="flex flex-col gap-[30px] mb-[30px]">
                {{-- arriba  --}}
                <div class="w-full flex gap-[24px] ">
                    <div class="w-1/2 flex flex-col items-center text-center bg-[#FFFFFF] px-[125px] pt-[70px] pb-[45px] gap-[30px]">
                        <img src="{{$nosotros->icono1}}" alt="">
                        <h1 class="text-[20px] font-bold text-[#0A3858]">{{$nosotros->nombre_icono1}}</h1>
                        <h3>{!! $nosotros->texto_icono1 !!}</h3>
                    </div>
                    <div class="w-1/2 flex flex-col items-center text-center bg-[#FFFFFF] px-[125px] pt-[70px] pb-[45px] gap-[30px]">
                        <img src="{{$nosotros->icono2}}" alt="">
                        <h1 class="text-[20px] font-bold text-[#0A3858]">{{$nosotros->nombre_icono2}}</h1>
                        <h3>{!! $nosotros->texto_icono2 !!}</h3>
                    </div>
                </div>
                {{-- abajo  --}}
                <div class="w-full flex flex-col items-center text-center bg-[#FFFFFF] px-[75px] pt-[70px] pb-[45px] gap-[30px]">
                    <img src="{{$nosotros->icono3}}" alt="">
                    <h1 class="text-[20px] font-bold text-[#0A3858]">{{$nosotros->nombre_icono3}}</h1>
                    <h3>{!! $nosotros->texto_icono3 !!}</h3>
                </div>
            </div>
            {{-- video  --}}
            <div>
               <video src="{{ $nosotros->video }}" class="w-full  mx-auto h-[688px]" controls  {{-- muestra los controles de reproducción --}}
                    preload="metadata"  {{-- carga solo metadatos al inicio --}}> 
                    Tu navegador no soporta la etiqueta video.
                </video>
            </div>
        </div>
    </div>
</div>

@endsection