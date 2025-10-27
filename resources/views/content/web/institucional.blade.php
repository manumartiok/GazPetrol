@php
    $institucional_ban = App\Models\InstitucionalBanner::first(); 
    $persona = App\Models\InstitucionalPersona::first(); 
    $institucionales = App\Models\Institucional::where('active', true)->orderBy('orden')->get(); 
@endphp

@extends('layouts.web')

@section('title', 'Institucional')

@section('content')

    {{-- banner  --}}

<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $institucional_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$institucional_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$institucional_ban->texto}}</h1>
    </div>
</div>

{{-- contenido  --}}

<div class=" h-full nunitosans flex flex-col">
    {{-- informacion  --}}
    <div class="h-full w-full bg-[#F5F5F5]">
        <div class="max-w-[1366px] mx-auto px-[73px]">
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[24px] py-[80px]">
                @foreach($institucionales as $institucional)
                    <div class="w-[392px] h-[632px] flex flex-col border rounded-[12px] bg-white">
                        <div class="w-full h-[260px]">
                            <img src="{{$institucional->foto}}" alt="" class="h-full w-full border rounded-t-[12px] ">
                        </div>
                        <div class="p-[20px] flex flex-col gap-[10px]">
                            <h1>{{$institucional->titulo}}</h1>
                            <h3>{{$institucional->texto}}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- persona  --}}
    <div class="h-full w-full py-[50px]">
        <div class="max-w-[1366px] mx-auto px-[73px] flex flex-col gap-[20px]">
            <div>
                <h1>{{$persona->nombre}}</h1>
            </div>
            {{-- foto y texto  --}}
            <div class="flex w-full">
                {{-- foto  --}}
                <div class="flex flex-col gap-[10px] flex-shrink-0" style="width: 155px;">
                    <div class="w-[155px] h-[192px]">
                        <img src="{{$persona->foto}}" alt="" class="w-full h-full object-cover object-center rounded">
                    </div>
                    <h2>{{$persona->cargo}}</h2>
                </div>
                {{-- texto 1 --}}
                <div class="h-auto ml-[20px]">
                    <h1>{{$persona->texto1}}</h1>
                </div>
                {{-- texto 2 --}}
                <div class="h-auto ml-[80px]">
                    <h1>{{$persona->texto2}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection