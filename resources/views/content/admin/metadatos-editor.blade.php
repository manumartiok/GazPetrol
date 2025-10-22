@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Editar Metadatos</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Editar metadato</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.metadatos-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="metadatos_id" value="{{ $metadato->id ?? '' }}">

                <div>
                    <div class="mb-4">

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="seccion">Seccion</label>
                        <input type="text" id="seccion" name="seccion" placeholder="Seccion" value="{{ $metadato->seccion ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="keywords">Keywords</label>
                        <input type="text" id="keywords" name="keywords" placeholder="Keyword" value="{{ $metadato->keywords ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="descripcion">Descripcion</label>
                        <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion" value="{{ $metadato->descripcion ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection