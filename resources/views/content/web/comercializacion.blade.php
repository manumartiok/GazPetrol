@php
    $comercios_ban = App\Models\ComercializacionBanner::first();
    $comercios = App\Models\Comercializacion::where('active', true)->orderBy('orden')->get(); 
@endphp

@extends('layouts.web')

@section('title', 'Comercializacion de Hidrocarburos')

@section('content')

{{-- banner  --}}

<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $comercios_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$comercios_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$comercios_ban->texto}}</h1>
    </div>
</div>

{{-- contenido  --}}
<div class="flex flex-col">
    {{-- informacion  --}}
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[20px] md:px-[73px] pt-[80px]">
        @foreach ($comercios as $comercio)
        <div class="flex flex-col md:flex-row gap-[20px] mb-[80px]
            @if($loop->iteration % 2 == 0) md:flex-row-reverse @endif">
            
            {{-- Imagen --}}
            <div class="w-full md:w-1/2">
                <img src="{{ $comercio->foto }}" alt="{{ $comercio->titulo }}" class="w-full h-auto object-cover">
            </div>

            {{-- Texto --}}
            <div class="w-full md:w-1/2 flex flex-col justify-center pr-0 md:pr-[20px] ">
                <h1 class="text-[32px] font-bold text-[#0A3858] mb-[10px]">{{ $comercio->titulo }}</h1>
                <h2 class="">{{ $comercio->texto }}</h2>
            </div>

        </div>
        @endforeach
    </div>
    {{-- solicitud  --}}
    <div class="w-full h-[450px] bg-cover bg-center flex flex-col text-white nunitosans justify-center items-center" style="background-image:url('assets/img/Solicitar.png');">
        <h1 class="mb-[20px] text-[32px] text-bold">Solicitud de presupuesto</h1>
        <h3 class="text-[20px] ">Hacé tu consulta y recibí un presupuesto adaptado a tu empresa y consumo. </h3>
        <a class="h-[41px] w-[198px] text-[16px] border border-[#5FBB46] rounded-[20px] bg-[#5FBB46] flex justify-center items-center mt-[52px]" href="{{route('solicitud')}}">Solicitar presupuesto</a>
    </div>
</div>
@endsection