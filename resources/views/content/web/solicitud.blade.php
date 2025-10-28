@php
       $solicitudes_ban = App\Models\SolicitudBanner::first(); 
       $productos = App\Models\Producto::where('active', true)->orderBy('orden')->get();
       $servicios = App\Models\Servicio::where('active', true)->orderBy('orden')->get();
@endphp

@extends('layouts.web')

@section('title', 'Solicitud')

@section('content')

{{-- banner  --}}

<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $solicitudes_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$solicitudes_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$solicitudes_ban->texto}}</h1>
    </div>
</div>
{{-- contenido --}}
<div class="nunitosans max-w-[1366px] mx-auto px-[73px] lg:px-[173px] py-[80px]">
    
    {{-- Datos de contacto --}}
    <h2 class="text-[32px] font-bold mb-6">Datos de contacto</h2>
    <form id="formSolicitud" action="{{ route('form.solicitud') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
        @csrf

        {{-- Fila 1 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="nombre" class="text-[16px] font-normal">Nombre y Apellido*</label>
                <input type="text" id="nombre" name="nombre" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="email" class="text-[16px] font-normal">Email*</label>
                <input type="email" id="email" name="email" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
        </div>

        {{-- Fila 2 --}}
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="telefono" class="text-[16px] font-normal">Teléfono*</label>
                <input type="tel" id="telefono" name="telefono" 
                    pattern="[0-9]*" 
                    inputmode="numeric"
                    class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="empresa" class="text-[16px] font-normal">Empresa*</label>
                <input type="text" id="empresa" name="empresa" class="h-[40px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
            </div>
        </div>

        {{-- Consulta --}}
        <h2 class="text-[32px] font-bold mt-4">Consulta</h2>
       {{-- Fila 3 --}}
        <div class="flex flex-col md:flex-row gap-6">

            {{-- Selector Producto --}}
            <div class="w-full md:w-1/2 flex flex-col gap-2 relative">
                <label class="text-[16px] font-normal">Producto*</label>
                <button type="button" id="dropdownProductoBtn" class="h-[40px] w-full border border-[#DCDCDC] rounded-full px-4 flex justify-between items-center bg-white hover:scale-100">
                    Seleccionar producto
                    <i class="fa-solid fa-chevron-down text-[#5C5C5C]/40"></i>
                </button>
                <ul id="dropdownProductoMenu" class="absolute w-full max-h-40 overflow-y-auto bg-white border rounded mt-[73px] hidden z-50">
                    @foreach($productos as $producto)
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $producto->id }}">{{ $producto->nombre }}</li>
                    @endforeach
                </ul>
                <input type="hidden" name="producto" id="productoInput" required>
            </div>

            {{-- Selector Servicio --}}
            <div class="w-full md:w-1/2 flex flex-col gap-2 relative">
                <label class="text-[16px] font-normal">Servicio*</label>
                <button type="button" id="dropdownServicioBtn" class="h-[40px] w-full border border-[#DCDCDC] rounded-full px-4 flex justify-between items-center bg-white hover:scale-100">
                    Seleccionar servicio
                    <i class="fa-solid fa-chevron-down text-[#5C5C5C]/40"></i>
                </button>
                <ul id="dropdownServicioMenu" class="absolute w-full max-h-40 overflow-y-auto bg-white border rounded mt-[73px] hidden z-50">
                    @foreach($servicios as $servicio)
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $servicio->id }}">{{ $servicio->nombre }}</li>
                    @endforeach
                </ul>
                <input type="hidden" name="servicio" id="servicioInput" required>
            </div>
        </div>

        {{-- Fila 4 --}}
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="archivo" class="text-[16px] ">Adjuntar archivo</label>
                <div class="relative w-full">
                    <input type="file" id="archivo" name="archivo" class="absolute inset-0 opacity-0 z-10 cursor-pointer" >
                    <div class="h-[40px] border border-[#DCDCDC] rounded-full text-[14px] text-[#5C5C5C] flex justify-between items-center px-4">
                        <span id="nombreArchivo" class="truncate">Seleccionar archivo</span>
                        <i class="fa-solid fa-arrow-up-from-bracket text-[#5C5C5C]/40"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Fila 5 (Aclaraciones + botón) --}}
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div class="w-full md:w-1/2 flex flex-col gap-2">
                <label for="aclaraciones" class="text-[16px] font-normal">Aclaraciones / Observaciones</label>
                <textarea id="aclaraciones" name="aclaraciones" rows="6" class="border border-[#DCDCDC] rounded-[10px] px-4 py-2 focus:outline-none resize-none"></textarea>
            </div>

            <div class="w-full md:w-1/2 flex flex-col mt-auto">
                <div class="flex items-center justify-between gap-4">
                    <h1 class="text-[16px] text-[#5C5C5C]">*Datos obligatorios</h1>
                    <button type="submit" class="w-full md:w-[290px] h-[40px] bg-[#0A3858] text-white rounded-[20px] text-[16px] hover:bg-[#082a45] transition">
                        Solicitar presupuesto
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const inputArchivo = document.getElementById('archivo');
        const nombreArchivo = document.getElementById('nombreArchivo');
        const telefonoInput = document.getElementById('telefono');


        // Permitir solo números en teléfono
        telefonoInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


        inputArchivo.addEventListener('change', function() {
            if (this.files.length > 0) {
                nombreArchivo.textContent = this.files[0].name;
            } else {
                nombreArchivo.textContent = 'Seleccionar archivo';
            }
        });

        // Función genérica para dropdown
        function setupDropdown(btnId, menuId, inputId) {
            const btn = document.getElementById(btnId);
            const menu = document.getElementById(menuId);
            const input = document.getElementById(inputId);

            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            menu.querySelectorAll('li').forEach(li => {
                li.addEventListener('click', () => {
                    btn.innerHTML = li.textContent + ' <i class="fa-solid fa-chevron-down text-[#5C5C5C]/40"></i>';
                    input.value = li.dataset.value;
                    menu.classList.add('hidden');
                });
            });

            document.addEventListener('click', (e) => {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        }

        setupDropdown('dropdownProductoBtn', 'dropdownProductoMenu', 'productoInput');
        setupDropdown('dropdownServicioBtn', 'dropdownServicioMenu', 'servicioInput');

        // AJAX para formulario de solicitud
        const formSolicitud = document.getElementById('formSolicitud');

        formSolicitud.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            submitBtn.disabled = true;
            submitBtn.textContent = 'Enviando...';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Solicitud enviada!',
                        text: data.message || 'Tu solicitud de presupuesto ha sido enviada exitosamente.',
                        confirmButtonColor: '#5FBB46'
                    });
                    formSolicitud.reset();
                    nombreArchivo.textContent = 'Seleccionar archivo';
                    document.getElementById('dropdownProductoBtn').innerHTML = 'Seleccionar producto <i class="fa-solid fa-chevron-down text-[#5C5C5C]/40"></i>';
                    document.getElementById('dropdownServicioBtn').innerHTML = 'Seleccionar servicio <i class="fa-solid fa-chevron-down text-[#5C5C5C]/40"></i>';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Hubo un problema al enviar tu solicitud.',
                        confirmButtonColor: '#0A3858'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error. Por favor, intenta nuevamente.',
                    confirmButtonColor: '#0A3858'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    });
</script>
@endsection