@php
    $redes = App\Models\Red::orderBy('orden')->get(); 
    $logos = App\Models\Logo::first(); 

      $whatsapp = App\Models\Red::where('icono', 'fa-brands fa-whatsapp') // o 'nombre', si preferís
                    ->where('active', 1)
                    ->first();
@endphp

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Titulo -->
    <title>@yield('title')</title>
    <!-- Cargar jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CSS  -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
     {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{-- google font  --}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
</head>
<body class="h-full flex flex-col">

    @if($whatsapp)
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp->url) }}" target="_blank" class="fixed bottom-[40px] right-[25px] z-50">
        <img src="/assets/img/whatsapp.png" alt="Chat" class=" cursor-pointer">
    </a>
    @endif
    <!-- header --> 

     <!-- navbar -->
        <nav class="fixed top-0 left-0 w-full z-50">
        <div id="navbar" class="nav-layout nunitosans flex items-center text-white justify-between mx-auto px-[73px] max-w-[1366px] h-[90px] gap-[80px]">
            
            <!-- Logo -->
            <div class="h-[53px] w-[222px] flex-shrink-0">
                <a href="{{route('home')}}"><img src="{{$logos->foto_nav}}" alt="Logo" class=""></a>
            </div>
            
            <!-- Botón Hamburguesa (solo en móvil) -->
            <button id="menu-toggle" class="lg:hidden text-2xl ml-auto">
            <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Contenedor del menú y botón -->
            <div class="hidden lg:flex items-center  flex-1">
            
            <!-- Menú centrado -->
            <div class="flex-1 flex justify-between mr-[80px] font-[400] text-[14px]">
                <a href="{{ route('nosotros') }}" class="{{ Request::is('nosotros') ? 'font-bold' : '' }}">Nosotros</a>
                <a href="{{ route('comercializacion') }}" class="{{ Request::is('comercializacion*') ? 'font-bold' : '' }}">Comercialización de hidrocarburos</a>
                <a href="{{ route('productos') }}" class="{{ Request::is('productos*') ? 'font-bold' : '' }}">Productos</a>
                <a href="{{ route('clientes') }}" class="{{ Request::is('clientes*') ? 'font-bold' : '' }}">Clientes</a>
                <a href="{{ route('institucional') }}" class="{{ Request::is('institucional*') ? 'font-bold' : '' }}">Institucional</a>
                <a href="{{ route('contacto') }}" class="{{ Request::is('contacto') ? 'font-bold' : '' }}">Contacto</a>
            </div>

            <a href="{{ route('solicitud') }}" class="max-w-[225px] w-full h-[41px] border rounded-[20px] bg-white text-[#0A3858] flex justify-center items-center ">
               Solicitud de presupuesto
            </a>
        </div>


        <!-- Menú mobile -->
        <div id="mobile-menu" class="lg:hidden  flex flex-col items-center gap-4 bg-white py-3">

        </div>
      
        </nav>

    <!-- contenido -->

    <div class="flex-grow">
        @yield('content')
    </div>
    
    <!-- footer  -->
    <footer class=" nunitosans text-white min-h-[415px] h-[415px]  flex flex-col justify-between bg-[#0A3858] ">

        <div class="h-full w-full max-w-[1366px] mx-auto px-[73px] pt-[45px] pb-[35px] flex justify-center lg:justify-between ">
            <div class="">
                    <img src="{{$logos->foto_footer}}" alt="" class="h-[53px] w-[222px]">
            </div>
            <div class=" hidden lg:flex pt-[15px]">
                <ul class="flex flex-col gap-[30px]">
                    <h3 class="text-[20px] font-[700]">Secciones</h3>
                    <div class="flex flex-col justify-between text-[16px] h-[200px] max-w-[132px]">
                            <li><a href="">Nosotros</a></li>
                            <li><a href=""></a>Comercialización de Hidrocarburos</li>
                            <li><a href=""></a>Productos</li>
                            <li><a href=""></a>Clientes</li>
                            <li><a href=""></a>Novedades</li>
                            <li><a href=""></a>Contacto</li>
                    </div>
                </ul>
            </div>
            <div class=" flex flex-col pt-[15px] gap-[30px]">
                <h3 class="text-[20px] font-[700]">Suscribite al Newsletter</h3>
                <form class="flex h-[45px] w-full md:w-[298px] bg-[#0A3858] border  rounded-[20px] overflow-hidden">
                    <input type="email" placeholder="Email" class="flex-1 px-4 text-white bg-[#0A3858] focus:outline-none">
                    <button type="submit" class="flex items-center justify-center px-4 bg-[#0A3858]">
                        <i class="fa-solid fa-arrow-right  "></i>
                    </button>
                </form>
            </div>
            <div class="flex flex-col pt-[15px]  gap-[30px]">
                <h3 class="text-[20px] font-[700]">Contacto</h3>
                <div class=" flex flex-col items-start gap-[20px] px-[5%] lg:px-[0%]">
                    @foreach($redes as $red)
                    <div class="flex gap-[10px] items-center">
                       <i class="{{$red->icono}} text-white "></i><a href="{{$red->url}}"><h3 class=" ">{{$red->nombre}}</h3></a> 
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-border min-h-[67px] h-[67px]  flex justify-between items-center px-12">
            <p> © Copyright &copy;<?php echo date("Y");?> Nilitos Snacks. Todos los derechos reservados</p>
            <a href="https://osole.com.ar/">By <span>Osole</span></a>
        </div>
    
    </footer>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>
</html>