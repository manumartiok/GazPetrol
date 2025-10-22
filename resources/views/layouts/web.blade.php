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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="h-full flex flex-col">

    <!-- header --> 

     <!-- navbar -->
        <nav class="fixed top-0 left-0 w-full z-50">
        <div id="navbar" class="nav-layout bg-[#FFFFFF]   flex items-center justify-between mx-auto px-10 max-w-[1366px] h-[90px]">
            
            <!-- Logo -->
            <div>

                <img src="{" alt="Logo" class="h-[67px] w-[138px] flex-shrink-0">
            </div>
            
            <!-- Botón Hamburguesa (solo en móvil) -->
            <button id="menu-toggle" class="lg:hidden text-2xl ml-auto">
            <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Contenedor del menú y botón -->
            <div class="hidden lg:flex items-center justify-between flex-1 max-w-[1000px] mx-auto gap-8">
            
            <!-- Menú centrado -->
            <div class="flex-1 flex justify-center gap-6">
                <a href="" class="">Nosotros</a>
                <a href="" class="">Comercialización de hidrocarburos</a>
                <a href="" class="">Productos</a>
                <a href="" class="">Clientes</a>
                <a href="" class="">Institucional</a>
                <a href="" class="">Contacto</a>
            </div>

            <div>

                <a href="">Solicitud de presupuesto</a>
            </div>
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
    <footer class="footer-layout h-[415px]  flex flex-col justify-between bg-[#0A3858] ">

        <div class="h-full flex flex-wrap justify-center lg:justify-between  pt-10 mb:pt-0">
            <div class="content-center basis-full  lg:basis-1/4 flex flex-col items-center justify-center gap-6">
                <div>
                    <img href="" alt="" class="h-[67px] w-[140px]">
                </div>
                <div class="flex justify-center gap-2">
                    <i class="fa-brands fa-facebook-f text-white h-[20px] w-[20px]"></i>
                    <i class="fa-brands fa-instagram text-white h-[20px] w-[20px]"></i>
                </div> 
            </div>
            <div class="content-center hidden lg:flex  lg:basis-1/4  items-center">
                <ul >
                    <h3 class="nunitosans font-[700]">Secciones</h3>
                    <div class="flex justify-between pt-6 space-x-11">
                        <div class="space-y-4">
                            <li><a href="">Nosotros</a></li>
                            <li><a href=""></a>Comercialización de Hidrocarburos</li>
                            <li><a href=""></a>Productos</li>
                            <li><a href=""></a>Clientes</li>
                            <li><a href=""></a>Novedades</li>
                            <li><a href=""></a>Contacto</li>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="content-center basis-full  lg:basis-1/4 space-y-4 flex flex-col items-center lg:block">
                <h3 class="nunitosans font-[700]">Suscribete al Newsletter</h3>
                <form class="flex justify-center md:justify-start h-[45px] w-full md:w-[298px]">
                    <input type="email" placeholder="Email" class="nunitosans font-[400] rounded-l-xl px-4 text-black placeholder-black focus:outline-none">
                    <button type="submit" class="bg-white text-orange-500 rounded-r-xl px-4 flex items-center justify-center">
                        <i class="fa-solid fa-arrow-right h-[24px] w-[24px] mt-2"></i>
                    </button>
                </form>
            </div>
            <div class="content-center basis-full  lg:basis-1/4 flex flex-col items-center lg:block ">
          
                <h3 class="nunitosans font-[700]">Contacto</h3>
                <div class="space-y-4 pt-6 flex flex-col items-start px-[5%] lg:px-[0%]">

                    <div class="flex space-x-1">
                        <i class="fa-solid fa-phone text-white h-[20px] w-[20px]"></i><p class="nunitosans font-[400]">H</p>
                    </div>
                    <div class="flex space-x-1">
                        <i class="fa-regular fa-envelope text-white h-[20px] w-[20px]"></i><p class="nunitosans font-[400]">H</p>
                    </div>

                </div>

            </div>
        </div>
        <div class="box-border min-h-[67px] h-[67px]  bg-[#0A3858]/10 z-10 flex justify-between items-center px-12">
            <p> © Copyright &copy;<?php echo date("Y");?> Nilitos Snacks. Todos los derechos reservados</p>
            <a href="https://osole.com.ar/">By <span>Osole</span></a>
        </div>
    
    </footer>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>
</html>