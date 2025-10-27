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
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] pt-[80px]">
        @foreach ($comercios as $comercio)
        <div class="flex w-full gap-[20px] mb-[80px] flex-col md:flex-row
            @if($loop->iteration % 2 == 0) md:flex-row-reverse @endif">
            
            <div class="w-1/2">
                <img src="{{$comercio->foto}}" alt="">
            </div>
            <div class="w-1/2">
                <h1>{{$comercio->titulo}}</h1>
                <h2>{{$comercio->texto}}</h2>
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