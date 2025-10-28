@extends('layouts.master')

@section('title', 'Newsletter')

@section('content')

    {{-- Cabezal --}}
    <div>
        <h3>Newsletter</h3>
        <hr class="mx-6">
    </div>

    {{-- Botón Crear Newsletter --}}
    <div class="p-4">
        <button id="btnCrearNewsletter" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            Crear Newsletter
        </button>
    </div>

    {{-- Tabla --}}
    <div class="p-4">
        <div class="overflow-x-auto rounded-2xl shadow">

            <table class="min-w-full border border-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr class="text-gray-700 text-sm uppercase">
                        <th class="px-4 py-3 text-left">Orden</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-center">Activo</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody id="lista-newsletter" class="text-gray-600">
                    @foreach($newsletter as $item)
                        <tr class="border-t hover:bg-gray-50 cursor-move" data-id="{{ $item->id }}">
                            <td class="px-4 py-3">{{ $item->orden }}</td>
                            <td class="px-4 py-3 w-64 max-w-64 truncate">{{ $item->email }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($item->active)
                                    <a href="{{ route('adm.newsletter-switch', $item->id) }}"
                                        class="badge bg-green-400 text-white px-4 py-2 rounded">
                                        Activo
                                    </a>
                                @else
                                    <a href="{{ route('adm.newsletter-switch', $item->id) }}"
                                        class="badge bg-red-400 text-white px-4 py-2 rounded">
                                        Inactivo
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-2 font-bold">
                                <a href="{{ route('adm.newsletter-destroy', $item->id) }}"
                                    class="text-red-600 hover:underline">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Crear Newsletter --}}
    <div id="modalNewsletter" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl mx-4">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-xl font-semibold">Crear newsletter</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="formEnviarNewsletter" action="{{ route('adm.newsletter-send') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <!-- Asunto -->
                    <div>
                        <label for="asunto" class="block text-sm font-medium text-gray-700 mb-2">Asunto:</label>
                        <input type="text" id="asunto" name="asunto" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                    </div>

                    <!-- Mensaje -->
                    <div>
                        <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-2">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" rows="10" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500"></textarea>
                    </div>
                </div>

                <div class="flex justify-end p-6 border-t">
                    <button type="submit" 
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            activarOrdenDragDrop('#lista-newsletter', '{{ route('adm.newsletter-reordenar') }}');

            // Abrir modal
            const btnCrearNewsletter = document.getElementById('btnCrearNewsletter');
            const modalNewsletter = document.getElementById('modalNewsletter');
            const closeModal = document.getElementById('closeModal');

            btnCrearNewsletter.addEventListener('click', () => {
                modalNewsletter.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => {
                modalNewsletter.classList.add('hidden');
            });

            // Cerrar modal al hacer clic fuera
            modalNewsletter.addEventListener('click', (e) => {
                if (e.target === modalNewsletter) {
                    modalNewsletter.classList.add('hidden');
                }
            });

            // Enviar newsletter con AJAX
            const formEnviarNewsletter = document.getElementById('formEnviarNewsletter');
            
            formEnviarNewsletter.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;

                // Deshabilitar botón
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
                            title: '¡Newsletter enviado!',
                            text: data.message,
                            confirmButtonColor: '#10B981'
                        });
                        modalNewsletter.classList.add('hidden');
                        formEnviarNewsletter.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonColor: '#EF4444'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al enviar el newsletter.',
                        confirmButtonColor: '#EF4444'
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