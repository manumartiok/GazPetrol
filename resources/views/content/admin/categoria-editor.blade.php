@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3 class="text-[20px] font-bold text-gray-500">Editar Categorias</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3 class="text-[18px] font-semibold  text-gray-600">Editar categoria</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.categorias-update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="categorias_id" value="{{ $categoria->id ?? '' }}">

                <div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" value="{{ $categoria->orden ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="categoria">Categoria</label>
                        <input type="text" id="categoria" name="categoria" placeholder="Categoria" value="{{ $categoria->categoria ?? '' }}"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="color">Color</label>
                        <input type="color" id="color" name="color" value="{{ $categoria->color ?? '#000000' }}"
                            class="w-16 h-10 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>
                <button type="submit" class="border rounded p-4 bg-white">Actualizar</button>
            </form>
        </div>            
    </div>
@endsection