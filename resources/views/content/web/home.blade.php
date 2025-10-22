@php
    $casa = App\Models\Home::first(); 

@endphp

@extends('layouts.web')

@section('title', 'Home')

@section('content')

    {{-- banner --}}
    <div>
    <h1></h1>
    <h1></h1>
    <a href="">Ver productos</a>
        
    </div>
    {{-- nosotros --}}
    <div class="flex ">
        <div class="w-1/2">
            <img src="{{$casa->foto}}" alt="Foto">
        </div>
        <div class="w-1/2">
            <div>
                <h3>Nosotros</h3>
                <h1>{{$casa->texto}}</h1>
                <h3>{{$casa->descripcion}}</h3>
                <a href="">Mas informacion</a>
            </div>
        </div>
        
    </div>
    {{-- novedades --}}
    <div>

    </div>
    {{-- clientes --}}
    <div>

    </div>

@endsection