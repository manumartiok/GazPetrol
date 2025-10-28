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
                    <h2 class="text-[20px] max-w-[371px]">{{ $banner->texto }}</h2>
                    <a href="{{route('productos')}}" class="w-full max-w-[184px] h-[41px] border rounded-[20px] bg-white text-[#0A3858] flex justify-center items-center">
                        Ver productos
                    </a>
                </div>
            </div>
        @endforeach

        {{-- Puntos convertidos en barras --}}
        @if($home_banner->count() > 1)
            <div class="absolute bottom-[124px] left-0 right-0 flex justify-start">
                <div class="w-full max-w-[1366px] mx-auto px-[73px] flex gap-[8px]">
                    @foreach($home_banner as $index => $banner)
                        <span class="carousel-dot h-[6px] w-[44px] bg-white/50 cursor-pointer  {{ $index === 0 ? 'bg-white' : '' }}" data-index="{{ $index }}"></span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>



    {{-- nosotros --}}
    <div class="flex flex-col lg:flex-row h-auto bg-[#0A3858] nunitosans text-white">
        <div class="w-full lg:w-1/2 flex flex-grow max-h-[600px] lg:max-h-none">
            <img src="{{$casa->foto}}" alt="Foto" class="w-full hobject-cover">
        </div>
        <div class="w-full lg:w-1/2 p-[60px] flex flex-col text-center lg:text-start">
            <div class="w-full lg:max-w-[550px]">
                <h3 class="text-[16px] font-bold text-[#5FBB46]">{{$casa->texto}}</h3>
                <h1 class="text-[32px] font-bold text-[#FFFFFF] mb-[25px]">{{$casa->sub_text}}</h1>
                <h3>{!! $casa->descripcion !!}</h3>
                <a href="{{route('nosotros')}}" class="flex h-[41px] w-[189px] border rounded-[20px] bg-white text-[16px] text-[#0A3858] justify-center items-center mt-[20px] mx-auto lg:mx-0">Mas información</a>
            </div>
        </div>
        
    </div>
    {{-- Institucional --}}
    <div class="h-auto bg-[#F5F5F5] py-10">
        <div class="nunitosans max-w-[1366px] mx-auto px-[40px] flex flex-col justify-center">
            <div>
                <h3 class="text-[16px] font-bold text-[#5FBB46]">{{$casa->texto2}}</h3>
            </div>
            <div>
                <h1 class="text-[32px] font-bold text-[#0A3858]">{{$casa->sub_text2}}</h1>
            </div>

            {{-- Slider --}}
            <div id="institucionalSlider" class="relative overflow-hidden mt-6">
                <div id="sliderTrack" class="flex transition-transform duration-500 ease-in-out">
                    @foreach($institucionales as $item)
                        <div class="flex-shrink-0 px-2 w-full md:w-1/2 lg:w-1/3">
                            <div class="bg-white shadow rounded-[12px] h-[487px] flex flex-col items-center">
                                <img src="{{ asset($item->foto) }}" alt="{{ $item->titulo }}" class="w-full h-[260px] object-cover rounded">
                                <div class="w-full h-full px-[25px] pt-[17px]">
                                    <h4 class="font-bold text-[24px] text-start truncate">{{ $item->titulo }}</h4>
                                    <h1 class="text-start text-[16px] overflow-hidden text-ellipsis mt-[10px]"
                                    style="
                                            display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            line-height: 1.2em;
                                            max-height: 3.6em;
                                    ">
                                        {!! $item->texto !!}
                                </h1>
                                </div>
                                <a href="{{ route('institucional') }}" class="text-[16px] text-black/50 px-[25px] mb-[34px] w-full flex justify-start hover:underline hover:scale-100">
                                    Leer más
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Dots --}}
                <div id="sliderDots" class="flex justify-center mt-4 space-x-2"></div>
            </div>
        </div>
    </div>

    {{-- clientes --}}
    <div class="h-auto lg:h-[332px] my-[40px] lg:my-0">
        <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-center">
            <div>
                <h3  class="text-[16px] font-bold text-[#5FBB46]">{{$casa->texto3}}</h3>
            </div>
            <div class="flex flex-row justify-between mb-[25px] mt-[4px]">
                <div >
                    <h1 class="text-[32px] font-bold text-[#0A3858]">{{$casa->sub_text3}}</h1>
                </div>
                    <a href="{{route('clientes')}}" class="w-[111px] h-[41px] flex justify-center items-center border border-[#0A3858] rounded-[20px] text-[16px] text-[#0A3858] shadow-md hover:shadow-lg">Ver todas</a>
            </div>
            <div class="w-full flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-[76px]">
                    @foreach($agrupados as $cliente)
                        <div class="w-[184px] h-[142px] border rounded-[8px] flex items-center justify-center filter grayscale hover:grayscale-0 transition duration-300">
                            <img src="{{ $cliente->foto }}" alt="{{ $cliente->texto }}" class="object-center">
                        </div>
                    @endforeach
                </div>
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
    const track = document.getElementById('sliderTrack');
    const dotsContainer = document.getElementById('sliderDots');
    const items = track.children;
    let currentIndex = 0;
    let itemsPerView = getItemsPerView();

    function getItemsPerView() {
        if (window.innerWidth >= 1024) return 3; // lg
        if (window.innerWidth >= 768) return 2; // md
        return 1; // sm
    }

    function updateSlider() {
        const totalItems = items.length;
        const totalPages = Math.ceil(totalItems / itemsPerView);
        const translateX = -(currentIndex * 100) / totalPages;
        track.style.transform = `translateX(${translateX}%)`;

        dotsContainer.innerHTML = '';
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('span');
            dot.className = `h-[6px] w-[44px] cursor-pointer transition-colors duration-300 ${
                i === currentIndex ? 'bg-[#CCCCCC]' : 'bg-[#CCCCCC]/30'
            }`;
            dot.addEventListener('click', () => {
                currentIndex = i;
                updateSlider();
            });
            dotsContainer.appendChild(dot);
        }
    }

    window.addEventListener('resize', () => {
        itemsPerView = getItemsPerView();
        currentIndex = 0;
        updateSlider();
    });

    updateSlider();
});
</script>
@endsection