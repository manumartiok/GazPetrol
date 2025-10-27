<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\PerfilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\NosotroController;
use App\Http\Controllers\NosotroBannerController;
use App\Http\Controllers\ComercializacionController;
use App\Http\Controllers\ComercializacionBannerController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoFotoController;
use App\Http\Controllers\ProductoBannerController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteBannerController;
use App\Http\Controllers\InstitucionalController;
use App\Http\Controllers\InstitucionalBannerController;
use App\Http\Controllers\InstitucionalPersonaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ContactoBannerController;
use App\Http\Controllers\SolicitudBannerController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\RedController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MetadatoController;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ProductoBanner;

//ADMIN
Route::middleware(AdminAuth::class)->group(function () {

    //ADMIN
    Route::get('/admin/dashboard', function () {
    return view('content.admin.admin-dashboard');})->name('adm.dashboard');

    //perfil
    Route::get('/admin/perfil', [PerfilController::class, 'show'])->name('adm.perfil');
    Route::post('/admin/perfil/update', [PerfilController::class, 'update'])->name('adm.perfil-update');

    //home banner
    Route::get('/admin/home/banner', [HomeBannerController::class,'index'])->name('adm.home-ban');
    Route::get('/admin/home/banner/creador', [HomeBannerController::class,'create'])->name('adm.home-ban-creador');
    Route::post('/admin/home/banner/store', [HomeBannerController::class,'store'])->name('adm.home-ban-store');
    Route::get('/admin/home/banner/editor/{home_banners_id}', [HomeBannerController::class,'show'])->name('adm.home-ban-editor');
    Route::post('/admin/home/banner/update', [HomeBannerController::class,'update'])->name('adm.home-ban-update');
    Route::get('/admin/home/banner/destroy/{home_banners_id}', [HomeBannerController::class,'destroy'])->name('adm.home-ban-destroy');
    Route::get('/admin/home/banner/switch/{home_banners_id}', [HomeBannerController::class,'switch'])->name('adm.home-ban-switch');
    Route::post('/admin/home-ban/reordenar', [HomeBannerController::class, 'reordenar'])->name('adm.home-ban-reordenar');

    //home contenido
    Route::get('/admin/home', [HomeController::class, 'show'])->name('adm.home');
    Route::post('/admin/home/update', [HomeController::class, 'update'])->name('adm.home-update');



    //nosotros
    Route::get('/admin/nosotros', [NosotroController::class, 'show'])->name('adm.nosotros');
    Route::post('/admin/nosotros/update', [NosotroController::class,'update'])->name('adm.nosotros-update');

    //nosotros banner
    Route::get('/admin/nosotros/banner', [NosotroBannerController::class, 'show'])->name('adm.nosotros-ban');
    Route::post('/admin/nosotros/banner/update', [NosotroBannerController::class,'update'])->name('adm.nosotros-ban-update');

    //comercializacion
    Route::get('/admin/comercio', [ComercializacionController::class,'index'])->name('adm.comercializacion');
    Route::get('/admin/comercio/creador', [ComercializacionController::class,'create'])->name('adm.comercializacion-creador');
    Route::post('/admin/comercio/store', [ComercializacionController::class,'store'])->name('adm.comercializacion-store');
    Route::get('/admin/comercio/editor/{comercio_id}', [ComercializacionController::class,'show'])->name('adm.comercializacion-editor');
    Route::post('/admin/comercio/update', [ComercializacionController::class,'update'])->name('adm.comercializacion-update');
    Route::get('/admin/comercio/destroy/{comercio_id}', [ComercializacionController::class,'destroy'])->name('adm.comercializacion-destroy');
    Route::get('/admin/comercio/switch/{comercio_id}', [ComercializacionController::class,'switch'])->name('adm.comercializacion-switch');
    Route::post('/admin/comercializacion/reordenar', [ComercializacionController::class, 'reordenar'])->name('adm.comercializacion-reordenar');


    //comercializacion banner
    Route::get('/admin/comercio/banner', [ComercializacionBannerController::class, 'show'])->name('adm.comercializacion-ban');
    Route::post('/admin/comercio/banner/update', [ComercializacionBannerController::class,'update'])->name('adm.comercializacion-ban-update');

    //categorias
    Route::get('/admin/categorias', [CategoriaController::class,'index'])->name('adm.categorias');
    Route::get('/admin/categorias/creador', [CategoriaController::class,'create'])->name('adm.categorias-creador');
    Route::post('/admin/categorias/store', [CategoriaController::class,'store'])->name('adm.categorias-store');
    Route::get('/admin/categorias/editor/{categoria_id}', [CategoriaController::class,'show'])->name('adm.categorias-editor');
    Route::post('/admin/categorias/update', [CategoriaController::class,'update'])->name('adm.categorias-update');
    Route::get('/admin/categorias/destroy/{categoria_id}', [CategoriaController::class,'destroy'])->name('adm.categorias-destroy');
    Route::get('/admin/categorias/switch/{categoria_id}', [CategoriaController::class,'switch'])->name('adm.categorias-switch');
    Route::post('/admin/categorias/reordenar', [CategoriaController::class, 'reordenar'])->name('adm.categorias-reordenar');

    //productos banner
    Route::get('/admin/productos/banner', [ProductoBannerController::class, 'show'])->name('adm.productos-ban');
    Route::post('/admin/productos/banner/update', [ProductoBannerController::class,'update'])->name('adm.productos-ban-update');

    //productos
    Route::get('/admin/productos', [ProductoController::class,'index'])->name('adm.productos');
    Route::get('/admin/productos/creador', [ProductoController::class,'create'])->name('adm.productos-creador');
    Route::post('/admin/productos/store', [ProductoController::class,'store'])->name('adm.productos-store');
    Route::get('/admin/productos/editor/{producto_id}', [ProductoController::class,'show'])->name('adm.productos-editor');
    Route::post('/admin/productos/update', [ProductoController::class,'update'])->name('adm.productos-update');
    Route::get('/admin/productos/destroy/{producto_id}', [ProductoController::class,'destroy'])->name('adm.productos-destroy');
    Route::get('/admin/productos/switch/{producto_id}', [ProductoController::class,'switch'])->name('adm.productos-switch');
    Route::post('/admin/productos/reordenar', [ProductoController::class, 'reordenar'])->name('adm.productos-reordenar');


    //productos fotos
    Route::post('/admin/productos_foto/store', [ProductoFotoController::class,'store'])->name('adm.productos-fotos-store');
    Route::get('/admin/productos_foto/destroy/{producto_foto_id}', [ProductoFotoController::class,'destroy'])->name('adm.productos-fotos-destroy');
    Route::get('/admin/productos_foto/switch/{producto_foto_id}', [ProductoFotoController::class,'switch'])->name('adm.productos-fotos-switch');
    Route::post('/admin/productos_foto/reordenar', [ProductoFotoController::class, 'reordenar'])->name('adm.productos-fotos-reordenar');

    //clientes
    Route::get('/admin/cliente', [ClienteController::class,'index'])->name('adm.clientes');
    Route::get('/admin/cliente/creador', [ClienteController::class,'create'])->name('adm.clientes-creador');
    Route::post('/admin/cliente/store', [ClienteController::class,'store'])->name('adm.clientes-store');
    Route::get('/admin/cliente/editor/{cliente_id}', [ClienteController::class,'show'])->name('adm.clientes-editor');
    Route::post('/admin/cliente/update', [ClienteController::class,'update'])->name('adm.clientes-update');
    Route::get('/admin/cliente/destroy/{cliente_id}', [ClienteController::class,'destroy'])->name('adm.clientes-destroy');
    Route::get('/admin/cliente/switch/{cliente_id}', [ClienteController::class,'switch'])->name('adm.clientes-switch');
    Route::get('/admin/cliente/destacado/{cliente_id}', [ClienteController::class,'destacado'])->name('adm.clientes-destacado');
    Route::post('/admin/clientes/reordenar', [ClienteController::class, 'reordenar'])->name('adm.clientes-reordenar');



    //clientes banner
    Route::get('/admin/clientes/banner', [ClienteBannerController::class, 'show'])->name('adm.clientes-ban');
    Route::post('/admin/clientes/banner/update', [ClienteBannerController::class,'update'])->name('adm.clientes-ban-update');

    //institucional
    Route::get('/admin/institucional', [InstitucionalController::class,'index'])->name('adm.institucional');
    Route::get('/admin/institucional/creador', [InstitucionalController::class,'create'])->name('adm.institucional-creador');
    Route::post('/admin/institucional/store', [InstitucionalController::class,'store'])->name('adm.institucional-store');
    Route::get('/admin/institucional/editor/{cliente_id}', [InstitucionalController::class,'show'])->name('adm.institucional-editor');
    Route::post('/admin/institucional/update', [InstitucionalController::class,'update'])->name('adm.institucional-update');
    Route::get('/admin/institucional/destroy/{cliente_id}', [InstitucionalController::class,'destroy'])->name('adm.institucional-destroy');
    Route::get('/admin/institucional/switch/{cliente_id}', [InstitucionalController::class,'switch'])->name('adm.institucional-switch');
    Route::get('/admin/institucional/destacado/{cliente_id}', [InstitucionalController::class,'destacado'])->name('adm.institucional-destacado');
    Route::post('/admin/institucional/reordenar', [InstitucionalController::class, 'reordenar'])->name('adm.institucional-reordenar');

    //institucional banner
    Route::get('/admin/institucional/banner', [InstitucionalBannerController::class, 'show'])->name('adm.institucional-ban');
    Route::post('/admin/institucional/banner/update', [InstitucionalBannerController::class,'update'])->name('adm.institucional-ban-update');

    //institucional persona
    Route::get('/admin/institucional/persona', [InstitucionalPersonaController::class, 'show'])->name('adm.institucional-persona');
    Route::post('/admin/institucional/persona/update', [InstitucionalPersonaController::class,'update'])->name('adm.institucional-persona-update');

    //contacto 
    Route::get('/admin/contacto', [ContactoController::class, 'show'])->name('adm.contacto');
    Route::post('/admin/contacto/update', [ContactoController::class,'update'])->name('adm.contacto-update');

    //contacto banner
    Route::get('/admin/contacto/banner', [ContactoBannerController::class, 'show'])->name('adm.contacto-ban');
    Route::post('/admin/contacto/banner/update', [ContactoBannerController::class,'update'])->name('adm.contacto-ban-update');

    //solicitud banner
    Route::get('/admin/solicitud/banner', [SolicitudBannerController::class, 'show'])->name('adm.solicitud-ban');
    Route::post('/admin/solicitud/banner/update', [SolicitudBannerController::class,'update'])->name('adm.solicitud-ban-update');

    //servicios
    Route::get('/admin/servicios', [ServicioController::class,'index'])->name('adm.servicios');
    Route::get('/admin/servicios/creador', [ServicioController::class,'create'])->name('adm.servicios-creador');
    Route::post('/admin/servicios/store', [ServicioController::class,'store'])->name('adm.servicios-store');
    Route::get('/admin/servicios/editor/{red_id}', [ServicioController::class,'show'])->name('adm.servicios-editor');
    Route::post('/admin/servicios/update', [ServicioController::class,'update'])->name('adm.servicios-update');
    Route::get('/admin/servicios/destroy/{red_id}', [ServicioController::class,'destroy'])->name('adm.servicios-destroy');
    Route::get('/admin/servicios/switch/{red_id}', [ServicioController::class,'switch'])->name('adm.servicios-switch');
    Route::post('/admin/servicios/reordenar', [ServicioController::class, 'reordenar'])->name('adm.servicios-reordenar');


    //logo
    Route::get('/admin/logo', [LogoController::class, 'show'])->name('adm.logo');
    Route::post('/admin/logo/update', [LogoController::class,'update'])->name('adm.logo-update');

    //redes
    Route::get('/admin/redes', [RedController::class,'index'])->name('adm.redes');
    Route::get('/admin/redes/creador', [RedController::class,'create'])->name('adm.redes-creador');
    Route::post('/admin/redes/store', [RedController::class,'store'])->name('adm.redes-store');
    Route::get('/admin/redes/editor/{red_id}', [RedController::class,'show'])->name('adm.redes-editor');
    Route::post('/admin/redes/update', [RedController::class,'update'])->name('adm.redes-update');
    Route::get('/admin/redes/destroy/{red_id}', [RedController::class,'destroy'])->name('adm.redes-destroy');
    Route::get('/admin/redes/switch/{red_id}', [RedController::class,'switch'])->name('adm.redes-switch');
    Route::post('/admin/redes/reordenar', [RedController::class, 'reordenar'])->name('adm.redes-reordenar');

    //usuarios
    Route::get('/admin/usuarios', [UsuarioController::class,'index'])->name('adm.usuarios');
    Route::get('/admin/usuarios/creador', [UsuarioController::class,'create'])->name('adm.usuarios-creador');
    Route::post('/admin/usuarios/store', [UsuarioController::class,'store'])->name('adm.usuarios-store');
    Route::get('/admin/usuarios/editor/{usuario_id}', [UsuarioController::class,'show'])->name('adm.usuarios-editor');
    Route::post('/admin/usuarios/update', [UsuarioController::class,'update'])->name('adm.usuarios-update');
    Route::get('/admin/usuarios/destroy/{usuario_id}', [UsuarioController::class,'destroy'])->name('adm.usuarios-destroy');
    Route::get('/admin/usuarios/switch/{usuario_id}', [UsuarioController::class,'switch'])->name('adm.usuarios-switch');

    //metadatos
    Route::get('/admin/metadatos', [MetadatoController::class,'index'])->name('adm.metadatos');
    Route::get('/admin/metadatos/creador', [MetadatoController::class,'create'])->name('adm.metadatos-creador');
    Route::post('/admin/metadatos/store', [MetadatoController::class,'store'])->name('adm.metadatos-store');
    Route::get('/admin/metadatos/editor/{metadato_id}', [MetadatoController::class,'show'])->name('adm.metadatos-editor');
    Route::post('/admin/metadatos/update', [MetadatoController::class,'update'])->name('adm.metadatos-update');
    Route::get('/admin/metadatos/destroy/{metadato_id}', [MetadatoController::class,'destroy'])->name('adm.metadatos-destroy');
});


//login
Route::get('/admin/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class,'login'])->name('login.post');
Route::post('/admin/logout', [AuthController::class,'logout'])->name('logout');
Route::post('/admin/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');



//WEB
Route::get('/', function () {
    return view('content.web.home');})->name('home');

Route::get('/nosotros', function () {
    return view('content.web.nosotros');})->name('nosotros');

Route::get('/comercializacion', function () {
    return view('content.web.comercializacion');})->name('comercializacion');

Route::get('/productos', function (Illuminate\Http\Request $request) {
    $categoria_seleccionada = $request->categoria ?? null;
    $categorias = App\Models\Categoria::where('active', true)->orderBy('orden')->get();
    $productos = App\Models\Producto::where('active', true)
                    ->when($categoria_seleccionada, fn($q) => $q->where('categoria_id', $categoria_seleccionada))
                    ->orderBy('orden')
                    ->get();
    $productos_ban = App\Models\ProductoBanner::first();
    
    return view('content.web.productos', compact('productos_ban', 'categorias', 'productos', 'categoria_seleccionada'));
})->name('productos');

// Vista de detalle
Route::get('/productos/detalle/{id}', [ProductoController::class, 'detalle'])->name('productos-detalle');

Route::get('/clientes', function () {
    return view('content.web.clientes');})->name('clientes');

Route::get('/institucional', function () {
    return view('content.web.institucional');})->name('institucional');

Route::get('/contacto', function () {
    return view('content.web.contacto');})->name('contacto');

Route::get('/solicitud', function () {
    return view('content.web.solicitud');})->name('solicitud');



