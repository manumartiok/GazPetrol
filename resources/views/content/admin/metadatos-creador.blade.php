@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Crear Metadatos</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Crear metadato</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.metadatos-store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="metadatos_id" value="{{ $metadato->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="seccion">Seccion</label>
                    <input type="text" name="seccion" id="seccion" placeholder="Seccion" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="keywords">Keywords</label>
                        <input type="text" id="keywords" name="keywords" placeholder="Keywords" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="descripcion">Descripcion</label>
                        <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>
                <button type="submit" class="border rounded p-4">Crear</button>
            </form>
        </div>            
    </div>
@endsection