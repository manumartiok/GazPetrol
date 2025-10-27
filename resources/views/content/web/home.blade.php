@php
    $casa = App\Models\Home::first(); 
    $home_banner = App\Models\HomeBanner::orderBy('orden')->get();
    $institucionales = App\Models\Institucional::where('active', true)->orderBy('orden')->get();

        $agrupados = App\Models\Cliente::where('active', 1)
        ->where('destacado', 1) 
        ->take(5) 
        ->orderby('orden')->get();
@endphp

@extends('layouts.web')

@section('title', 'Home')

@section('content')

    {{-- Banner Carrusel --}}
    <div id="bannerCarousel" class="relative nunitosans w-full overflow-hidden h-[768px]">
        @foreach($home_banner as $index => $banner)
            <div class="carousel-slide absolute inset-0 transition-opacity duration-500 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                style="background-image: url('{{ $banner->foto ? asset($banner->foto) : '' }}'); background-size: cover; background-position: center;">
                
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-black/30"></div>

                {{-- Contenido sobre la foto --}}
                <div class="relative  text-white space-y-4 p-6 flex flex-col items-start justify-center h-full max-w-[1366px] mx-auto px-[73px]">
                    <h1 class="text-[78px] font-bold">{{ $banner->titulo }}</h1>
                    <h2 class="text-[20px] max-w-[371px] ">{{ $banner->texto }}</h2>
                    <a href="" class="w-full max-w-[184px] h-[41px] border rounded-[20px] bg-white text-[#0A3858] flex justify-center items-center">
                        Ver productos
                    </a>
                </div>
            </div>
        @endforeach

        @if($home_banner->count() > 1)
            {{-- Puntos convertidos en barras --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-1 w-1/3">
                @foreach($home_banner as $index => $banner)
                    <span class="carousel-dot flex-1 h-2 bg-white/50 {{ $index === 0 ? 'bg-white' : '' }}" data-index="{{ $index }}"></span>
                @endforeach
            </div>
        @endif
    </div>



    {{-- nosotros --}}
    <div class="flex h-auto bg-[#0A3858] nunitosans text-white">
        <div class="w-1/2">
            <img src="{{$casa->foto}}" alt="Foto" class="w-full hobject-cover">
        </div>
        <div class="w-1/2">
            <div>
                <h3>{{$casa->texto}}</h3>
                <h1>{{$casa->sub_text}}</h1>
                <h3>{{$casa->descripcion}}</h3>
                <a href="">Mas informacion</a>
            </div>
        </div>
        
    </div>
    {{-- Institucional --}}
    <div class="h-[747px] bg-[#F5F5F5]"> 
        <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-center">
            <div>
                <h3>{{$casa->texto2}}</h3>
            </div>
            <div>
                <h1>{{$casa->sub_text2}}</h1>
            </div>
            <div>
                    @php
                        $chunkedInstitucional = $institucionales->chunk(3); // Divide en bloques de 3
                    @endphp
                <div id="institucionalSlider" class="relative overflow-hidden mt-4">
                    <div class="flex transition-transform duration-500" style="width: {{ $chunkedInstitucional->count() * 100 }}%;">
                        @foreach($chunkedInstitucional as $chunkIndex => $chunk)
                            <div class="flex justify-center gap-4" style="width: {{ 100 / $chunkedInstitucional->count() }}%;">
                                @foreach($chunk as $item)
                                    <div class="bg-white shadow rounded-[12px] h-full w-full max-w-[392px] max-h-[487px] flex flex-col items-center">
                                        <img src="{{ asset($item->foto) }}" alt="{{ $item->titulo }}" class="w-full h-48 object-cover rounded mb-2">
                                        <div class="w-full h-full px-[25px] pt-[17px]">
                                            <h4 class="font-bold text-lg text-start">{{ $item->titulo }}</h4>
                                            <p class="text-center">{{ $item->texto }}</p>
                                        </div>
                                        <a href="" class="text-[16px] text-black px-[25px] mb-[34px] w-full flex justify-start">Leer mas</a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                        {{-- Selector inferior --}}
                        @if($chunkedInstitucional->count() > 1)
                            <div class="flex justify-center mt-4 space-x-2">
                                @foreach($chunkedInstitucional as $index => $chunk)
                                    <span class="slider-dot w-8 h-2 bg-gray-300 rounded cursor-pointer {{ $index === 0 ? 'bg-gray-700' : '' }}" data-index="{{ $index }}"></span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
    {{-- clientes --}}
    <div class="h-[332px] ">
        <div class=" h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-center">
            <div>
                <h3>{{$casa->texto3}}</h3>
            </div>
            <div class="flex flex-row justify-between mb-[25px] mt-[4px]">
                <div >
                    <h1>{{$casa->sub_text3}}</h1>
                </div>
                    <a href="" class="w-[111px] h-[41px] flex justify-center items-center border border-[#0A3858] rounded-[20px] text-[16px] text-[#0A3858] shadow-md hover:shadow-lg">Ver todas</a>
            </div>
                <div class="w-full grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-[76px]">
                    @foreach($agrupados as $cliente)
                            <div class="w-[184px] h-[142px] border rounded-[8px] flex items-center justify-center filter grayscale hover:grayscale-0 transition duration-300">
                                <img src="{{ $cliente->foto }}" alt="{{ $cliente->texto }}" class=" object-center">
                            </div>
                    @endforeach
                </div>
        </div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // -------- Banner Carrusel --------
    const bannerSlides = document.querySelectorAll('#bannerCarousel .carousel-slide');
    const bannerDots = document.querySelectorAll('#bannerCarousel .carousel-dot');
    let bannerCurrent = 0;

    function showBannerSlide(index) {
        bannerSlides.forEach((slide, i) => {
            slide.classList.toggle('opacity-100', i === index);
            slide.classList.toggle('opacity-0', i !== index);
        });
        bannerDots.forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === index);
            dot.classList.toggle('bg-white/50', i !== index);
        });
        bannerCurrent = index;
    }

    if(bannerSlides.length > 0){
        let autoBannerSlide = setInterval(() => {
            const nextIndex = (bannerCurrent === bannerSlides.length - 1) ? 0 : bannerCurrent + 1;
            showBannerSlide(nextIndex);
        }, 5000);

        bannerDots.forEach(dot => {
            dot.addEventListener('click', () => {
                showBannerSlide(parseInt(dot.dataset.index));
                clearInterval(autoBannerSlide);
                autoBannerSlide = setInterval(() => {
                    const nextIndex = (bannerCurrent === bannerSlides.length - 1) ? 0 : bannerCurrent + 1;
                    showBannerSlide(nextIndex);
                }, 5000);
            });
        });
    }

    // -------- Institucional Slider --------
    const institucionalSlider = document.querySelector('#institucionalSlider > div');
    const institucionalDots = document.querySelectorAll('#institucionalSlider .slider-dot');
    let institucionalCurrent = 0;
    const institucionalTotal = {{ $chunkedInstitucional->count() }};

    function goToInstitucionalSlide(index) {
        institucionalSlider.style.transform = `translateX(-${index * 100}%)`;
        institucionalDots.forEach((dot, i) => {
            dot.classList.toggle('bg-gray-700', i === index);
            dot.classList.toggle('bg-gray-300', i !== index);
        });
        institucionalCurrent = index;
    }

    institucionalDots.forEach(dot => {
        dot.addEventListener('click', () => {
            goToInstitucionalSlide(parseInt(dot.dataset.index));
        });
    });
});
</script>
@endsection