@php
    $contacto_ban = App\Models\ContactoBanner::first(); 
    $contacto = App\Models\Contacto::first(); 
    $redes = App\Models\Red::where('active', true)->orderBy('orden')->get(); 
@endphp

@extends('layouts.web')

@section('title', 'Contacto')

@section('content')

{{-- banner --}}
<div class="w-full h-[450px] bg-cover bg-center nunitosans text-white pt-[114px] pb-[140px]" style="background-image: url('{{ $contacto_ban->foto }}');">
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] flex flex-col justify-between">
        <h3 class="text-[12px]">Inicio > {{$contacto_ban->texto}}</h3>
        <h1 class="text-[48px] font-bold">{{$contacto_ban->texto}}</h1>
    </div>
</div>

{{-- contenido --}}
<div>
    <div class="h-full nunitosans max-w-[1366px] mx-auto px-[73px] py-[80px] flex flex-col gap-[15px]">
        {{-- texto --}}
        <div class="w-full">
            <div class="w-full md:w-1/3 md:pr-[20px] flex flex-col items-center text-center md:text-start md:items-start">
                <h2 class="font-bold text-[16px] text-[#5FBB46] mb-[-10px]">{{$contacto->titulo}}</h2>
                <h1 class="text-[32px] font-bold mb-[20px]">{{$contacto->sub}}</h1>
                <h3 class="text-[16px] ">{{$contacto->texto}}</h3>
            </div>
        </div>

        {{-- formulario y redes --}}
        <div class="flex flex-col md:flex-row w-full gap-[40px]">
            {{-- redes --}}
            <div class="flex flex-col items-center md:items-start w-full md:w-1/3 gap-[18px]">
               @foreach($redes as $red)
                    <div class="flex gap-[10px] items-center">
                       <i class="{{$red->icono}} text-green-400 "></i><a href="{{$red->url}}"><h3 class="text-[16px]">{{$red->nombre}}</h3></a> 
                    </div>
               @endforeach
            </div>
            {{-- formulario --}}
            <div class="w-full md:w-2/3">
                <form id="formContacto" action="{{ route('form.contacto') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col gap-8">
                @csrf
                <!-- Fila 1 -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-1/2 flex flex-col gap-2">
                        <label for="nombre" class="text-[16px] font-normal text-[#000]">Nombre*</label>
                        <input type="text" id="nombre" name="nombre" class="h-[48px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col gap-2">
                        <label for="apellido" class="text-[16px] font-normal text-[#000]">Apellido*</label>
                        <input type="text" id="apellido" name="apellido" class="h-[48px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
                    </div>
                </div>

                <!-- Fila 2 -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-1/2 flex flex-col gap-2">
                        <label for="email" class="text-[16px] font-normal text-[#000]">Email*</label>
                        <input type="email" id="email" name="email" class="h-[48px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none" required>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col gap-2">
                        <label for="celular" class="text-[16px] font-normal text-[#000]">Celular</label>
                        <input type="tel" id="celular" name="celular" 
                            pattern="[0-9]*" 
                            inputmode="numeric"
                            class="h-[48px] border border-[#DCDCDC] rounded-full px-4 focus:outline-none">
                    </div>
                </div>

                <!-- Fila 3 (Mensaje y datos obligatorios) -->
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-1/2 flex flex-col gap-2">
                        <label for="mensaje" class="text-[16px] font-normal text-[#000]">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="5" class=" border border-[#DCDCDC] rounded-[22px] px-4 py-3 focus:outline-none resize-none"></textarea>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col justify-between gap-4 md:pl-[15px]">
                        <h2 class="text-[16px] text-[#000] mt-[25px]">*Datos obligatorios</h2>
                        <button type="submit" class=" w-full md:w-[391px] h-[41px] bg-[#0A3858] text-white rounded-[20px] text-[16px] ">
                            Enviar consulta
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>


    </div>

        {{-- mapa --}}
    <div class="w-full h-[500px] mb-[75px] relative overflow-hidden">
        <iframe 
            src="{!! $contacto->ubicacion !!}" 
            width="100%" 
            height="100%" 
            style="border:0; filter: grayscale(100%) opacity(90%);" 
            allowfullscreen 
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const formContacto = document.getElementById('formContacto');
    const celularInput = document.getElementById('celular');

    // Permitir solo números en celular
    celularInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    formContacto.addEventListener('submit', function(e) {
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
                    title: '¡Mensaje enviado!',
                    text: data.message || 'Tu consulta ha sido enviada exitosamente.',
                    confirmButtonColor: '#5FBB46'
                });
                formContacto.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Hubo un problema al enviar tu consulta.',
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