@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

   {{-- cabezal --}}
    <div>
        <h3>Crear Productos</h3>
        <hr class="mx-6">
    </div>
    
    {{-- Editor --}}
    <div class="mx-20 pt-6" id="app">
        <div class="border border-rounded p-4">
            <div>
                <h3>Crear producto</h3>
            </div>
            <hr class="my-3">
            
            <form method="POST" action="{{ route('adm.productos-store') }}" enctype="multipart/form-data" @submit.prevent="handleSubmit"> 
                @csrf
                <input type="hidden" name="productos_id" value="{{ $producto->id ?? '' }}">

                <div>
                    <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2" for="foto_producto">Foto</label>
                    <input type="file" name="foto_producto" id="foto_producto" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="categoria_id">Categoría</label>
                        <select name="categoria_id" id="categoria_id"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccionar categoría</option>
                            @foreach($categoria as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="orden">Orden</label>
                        <input type="text" id="orden" name="orden" placeholder="Orden" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>


                    {{-- 🔽 Editor Quill para el detalle --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="detalle">Detalle</label>
                        <div class="quill-editor bg-white" data-field="detalle" style="height: 150px;"></div>
                        <input type="hidden" name="detalle" id="detalle">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="ficha_tecnica">Ficha Técnica</label>
                        <input type="file" name="ficha_tecnica" id="ficha_tecnica" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                </div>
                <button type="submit" class="border rounded p-4">Actualizar</button>
            </form>
        </div>     
    </div>
@endsection

@push('scripts')
@include('includes.quill-init')
@endpush