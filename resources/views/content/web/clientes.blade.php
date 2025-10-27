@php
 $clientes_ban = App\Models\ClienteBanner::first(); 
 $clientes = App\Models\Cliente::where('active', true)->orderBy('orden')->get(); 
@endphp

@extends('layouts.web')

@section('title', 'Clientes')

@section('content')

{{-- banner  --}}

<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $clientes_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$clientes_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$clientes_ban->texto}}</h1>
    </div>
</div>
{{-- contenido  --}}

<div class="nunitosans max-w-[1366px] mx-auto px-[73px] py-[50px]">
              <div class="w-full grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-[76px]">
                    @foreach($clientes as $cliente)
                            <div class="w-[184px] h-[142px] border rounded-[8px] flex items-center justify-center filter grayscale hover:grayscale-0 transition duration-300">
                                <img src="{{ $cliente->foto }}" alt="{{ $cliente->texto }}" class=" object-center">
                            </div>
                    @endforeach
                </div>
</div>

@endsection