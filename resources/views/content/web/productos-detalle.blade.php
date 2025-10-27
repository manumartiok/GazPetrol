@php
    $productos_ban = App\Models\ProductoBanner::first();
    $categorias = App\Models\Categoria::where('active', true)->orderBy('orden')->get();
    $otrosProductos = $producto->categoria->productos()->where('id', '!=', $producto->id)->take(3)->get();
@endphp

@extends('layouts.web')

@section('title', $producto->nombre)

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
<div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] py-[80px]">

    {{-- Breadcrumb --}}
    <div class="flex mb-[40px] text-[12px]">
        <div class="font-bold">Inicio &gt; Productos &gt; {{ $producto->categoria->categoria }} &gt;</div>
        <div class="ml-1">{{$producto->nombre}}</div>
    </div>

    <div class="flex gap-8">

        {{-- Categorías --}}
        <div class="w-1/4">
            <h1 class="text-[#1A181C]/50 font-bold">CATEGORÍAS</h1>
            <hr class="my-[20px]">
            <div class="flex flex-col gap-[20px]">
                @foreach ($categorias as $categoria)
                    <div>
                        <a href="{{ route('productos', ['categoria' => $categoria->id]) }}"
                           class="categoria-btn cursor-pointer {{ $categoria->id == $producto->categoria_id ? 'font-bold' : '' }}"
                           style="{{ $categoria->id == $producto->categoria_id ? 'color:'.$categoria->color : '' }}">
                            {{ $categoria->categoria }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Producto --}}
        <div class="w-3/4 flex flex-col gap-[14px] ">
            {{-- Imagen y detalle --}}
            <div class="flex gap-4">
                {{-- Imagen principal --}}
                <div class="h-[390px] w-[390px] border rounded-[8px] overflow-hidden flex-shrink-0 relative">
                    <img id="foto-principal"
                        src="{{ $producto->fotos->first()->foto ?? $producto->foto_producto }}"
                        alt="Foto principal"
                        class="h-full w-full object-cover transition-all duration-300">
                </div>

                {{-- Detalle del producto --}}
                <div class="flex flex-col flex-1">
                    <h1 class="text-[32px]">{{ $producto->nombre }}</h1>
                    <hr class="mb-[25px]">
                    <h3>{{ $producto->detalle }}</h3>
                    <div class="flex justify-between mt-auto gap-4">
                        @if($producto->ficha_tecnica)
                            <a href="{{ $producto->ficha_tecnica }}" target="_blank"
                            class="w-[233px] h-[41px] text-[16px] text-[#0A3858] border border-[#0A3858] rounded-[20px] flex justify-center items-center">
                                Ficha técnica
                            </a>
                        @endif
                        <a href="{{ route('solicitud') }}"
                        class="w-[233px] h-[41px] text-[16px] bg-[#0A3858] text-white rounded-[20px] flex justify-center items-center">
                            Solicitar presupuesto
                        </a>
                    </div>
                </div>
            </div>

            {{-- Carrusel de fotos --}}
            @if($producto->fotos->count() > 1)
                <div class="mt-4 max-w-[390px] overflow-x-auto">
                    <div class="flex gap-4 w-max pb-2">
                        @foreach($producto->fotos as $foto)
                            <img src="{{ $foto->foto }}" 
                                alt="imagen"
                                class="w-[90px] h-[80px] object-cover rounded cursor-pointer border border-transparent hover:border-[#0A3858] transition-all duration-200 mini-foto">
                        @endforeach
                    </div>
                </div>
            @endif
            {{-- Productos relacionados --}}
            <div class="flex flex-col mt-12">
                <h1 class="text-[32px] mb-[24px]">Productos relacionados</h1>
                <div class="flex gap-4">
                    @foreach ($otrosProductos as $rel)
                        <a href="{{ route('productos-detalle', ['id' => $rel->id]) }}"
                           class="flex flex-col border border-[#DEDFE0] rounded-[12px] text-center producto-item 
                                  transition-all duration-300 ease-in-out hover:scale-100"
                           data-categoria="{{ $rel->categoria_id }}">
                            
                            <div class="relative w-full h-[287px] mb-[14px] overflow-hidden group rounded">
                                <img src="{{ $rel->foto_producto }}" alt="" class="h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gray-300/0 transition-all duration-300 ease-in-out group-hover:bg-gray-300/20"></div>
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="text-white text-4xl font-bold">+</span>
                                </div>
                            </div>

                            <div class="flex flex-col px-[40px] pb-[40px]">
                                <h1 class="text-[{{ $rel->categoria->color }}] text-[12px] font-bold">
                                    {{ $rel->categoria->categoria }}
                                </h1>
                                <h2 class="text-[20px]">{{ $rel->nombre }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>

{{-- script filtrado --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const categorias = document.querySelectorAll('.categoria-btn');
    const productos = document.querySelectorAll('.producto-item');
    
    // Usar la categoría seleccionada desde el backend o la primera por defecto
    let selectedId = "{{ $categoria_seleccionada ?? ($categorias->first()->id ?? '') }}";

    // Marcar la categoría seleccionada
    categorias.forEach(c => {
        if(c.dataset.id === selectedId){
            c.classList.add('font-bold');
            c.style.color = c.dataset.color;
        }

        c.addEventListener('click', () => {
            const id = c.dataset.id;
            const color = c.dataset.color;

            // Resetear estilos de todas
            categorias.forEach(cc => {
                cc.classList.remove('font-bold');
                cc.style.color = '';
            });

            // Marcar la seleccionada
            c.classList.add('font-bold');
            c.style.color = color;

            // Filtrar productos
            productos.forEach(p => {
                p.style.display = (p.dataset.categoria === id) ? 'flex' : 'none';
            });
        });
    });

    // Filtrar productos al cargar la página
    productos.forEach(p => {
        p.style.display = (p.dataset.categoria === selectedId) ? 'flex' : 'none';
    });

    // --- Carrusel de fotos ---
    const miniFotos = document.querySelectorAll('.mini-foto');
    const fotoPrincipal = document.getElementById('foto-principal');

    miniFotos.forEach(foto => {
        foto.addEventListener('click', () => {
            // Cambiar imagen principal
            fotoPrincipal.src = foto.src;

            // Quitar borde de todas las miniaturas
            miniFotos.forEach(f => f.classList.remove('border-[#0A3858]'));

            // Marcar la miniatura seleccionada
            foto.classList.add('border-[#0A3858]');
        });
    });
});
</script>

@endsection