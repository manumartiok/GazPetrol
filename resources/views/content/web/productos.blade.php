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
<div class=" nunitosans w-full max-w-[1366px] mx-auto px-[73px] pt-[80px] pb-[50px] gap-[24px] flex">

    {{-- categorias --}}
    <div class="w-1/4">
        <h1 class="text-[#1A181C]/50">CATEGORÍAS</h1>
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
                <a href="{{ route('productos-detalle', ['id' => $producto->id, 'categoria' => $producto->categoria_id]) }}"
                    class="flex flex-col border border-[#DEDFE0] rounded-[12px] text-center producto-item 
                            transition-all duration-300 ease-in-out hover:scale-100"
                    data-categoria="{{ $producto->categoria_id }}">
                    
                    {{-- Imagen con overlay y signo de + --}}
                    <div class="relative w-full h-[287px] mb-[14px] overflow-hidden group rounded">
                        <img src="{{$producto->foto_producto}}" 
                            alt="" 
                            class="h-full w-full object-cover">
                        
                        {{-- Fondo gris semitransparente al hover --}}
                        <div class="absolute inset-0 bg-gray-300/0 transition-all duration-300 ease-in-out group-hover:bg-gray-300/20"></div>
                        
                        {{-- Signo + centrado al hover --}}
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-white text-4xl font-bold">+</span>
                        </div>
                    </div>

                    {{-- Texto --}}
                    <div class="flex flex-col px-[40px] pb-[40px]">
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

    // Tomar la categoría seleccionada desde backend o fallback a la primera
    let selectedId = "{{ $categoria_seleccionada ?? $categorias->first()->id }}";

    // Marcar la categoría seleccionada
    categorias.forEach(c => {
        if(c.dataset.id == selectedId){
            c.classList.add('font-bold');
            c.style.color = c.dataset.color;
        }

        c.addEventListener('click', () => {
            const id = c.dataset.id;
            const color = c.dataset.color;

            // Resetear todas
            categorias.forEach(cc => {
                cc.classList.remove('font-bold');
                cc.style.color = '';
            });

            // Marcar la seleccionada
            c.classList.add('font-bold');
            c.style.color = color;

            // Mostrar productos de esa categoría
            productos.forEach(p => {
                p.style.display = (p.dataset.categoria == id) ? 'flex' : 'none';
            });
        });
    });

    // Filtrar productos al cargar la página según categoría seleccionada
    productos.forEach(p => {
        p.style.display = (p.dataset.categoria == selectedId) ? 'flex' : 'none';
    });
});
</script>

@endsection