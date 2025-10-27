@php
    $productos_ban = App\Models\ProductoBanner::first();
    $categorias = App\Models\Categoria::where('active', true)->orderBy('orden')->get();
    $productos = App\Models\Producto::where('active', true)->orderBy('orden')->get();
@endphp

@extends('layouts.web')

@section('title', 'Productos')

@section('content')

{{-- banner --}}
<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]"
     style="background-image: url('{{ $productos_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$productos_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$productos_ban->texto}}</h1>
    </div>
</div>

{{-- contenido --}}
<div class="h-full nunitosans w-full max-w-[1366px] mx-auto px-[73px] pt-[80px] pb-[50px] gap-[24px] flex">

    {{-- categorias --}}
    <div class="w-1/4">
        <h1>CATEGORÍAS</h1>
        <hr class="my-[20px]">
        <div class="flex flex-col gap-[20px]">
            @foreach ($categorias as $categoria)
                <div>
                    <button class="categoria-btn cursor-pointer" data-id="{{ $categoria->id }}" data-color="{{ $categoria->color }}">
                        {{ $categoria->categoria }}
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    {{-- productos --}}
    <div class="w-3/4">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[24px] justify-center">
            @foreach ($productos as $producto)
                <a href="#"
                   class="flex flex-col p-[40px] border border-[#DEDFE0] rounded text-center producto-item"
                   data-categoria="{{ $producto->categoria_id }}">
                    <div class="w-full h-[287px] mb-[14px]">
                        <img src="{{$producto->foto_producto}}" alt="" class="h-full w-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-[{{$producto->categoria->color}}] text-[12px] font-bold">
                            {{$producto->categoria->categoria}}
                        </h1>
                        <h2 class="text-[20px]">{{$producto->nombre}}</h2>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>

{{-- script filtrado --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const categorias = document.querySelectorAll('.categoria-btn');
    const productos = document.querySelectorAll('.producto-item');

    // Marcar primera categoría por defecto
    if(categorias.length) {
        const firstColor = categorias[0].dataset.color;
        categorias[0].classList.add('font-bold');
        categorias[0].style.color = firstColor;
    }

    categorias.forEach(cat => {
        cat.addEventListener('click', () => {
            const id = cat.dataset.id;
            const color = cat.dataset.color;

            // Marcar la seleccionada
            categorias.forEach(c => {
                c.classList.remove('font-bold');
                c.style.color = ''; // volver al color por defecto
            });

            cat.classList.add('font-bold');
            cat.style.color = color;

            // Mostrar solo productos de la categoría seleccionada
            productos.forEach(p => {
                p.style.display = (p.dataset.categoria === id) ? 'flex' : 'none';
            });
        });
    });

    // Inicialmente mostrar solo productos de la primera categoría
    if(categorias.length) {
        const firstId = categorias[0].dataset.id;
        productos.forEach(p => {
            p.style.display = (p.dataset.categoria === firstId) ? 'flex' : 'none';
        });
    }
});
</script>

@endsection