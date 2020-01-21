<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('almacen/categoria','CategoriaController');
Route::put('almacen/categoria/update/{id}','CategoriaController@update')->name('almacen.categoria.update');
Route::get('almacen/categoria/{id}','CategoriaController@show')->name('almacen.categoria.show');
Route::get('almacen/categoria/destroy/{id}','CategoriaController@destroy')->name('almacen.categoria.destroy');

Route::resource('almacen/articulo','ArticuloController');
Route::put('almacen/articulo/update/{id}','ArticuloController@update')->name('almacen.articulo.update');
Route::get('almacen/articulo/{id}','ArticuloController@show')->name('almacen.articulo.show');
Route::get('almacen/articulo/destroy/{id}','ArticuloController@destroy')->name('almacen.articulo.destroy');


Route::resource('ventas/cliente','ClienteController');
Route::put('ventas/cliente/update/{id}','ClienteController@update')->name('ventas.cliente.update');
Route::get('ventas/cliente/{id}','ClienteController@show')->name('ventas.cliente.show');
Route::get('ventas/cliente/destroy/{id}','ClienteController@destroy')->name('ventas.cliente.destroy');


Route::resource('compras/proveedor','ProveedorController');
Route::put('compras/proveedor/update/{id}','ProveedorController@update')->name('compras.proveedor.update');
Route::get('compras/proveedor/{id}','ProveedorController@show')->name('compras.proveedor.show');
Route::get('compras/proveedor/destroy/{id}','ProveedorController@destroy')->name('compras.proveedor.destroy');

Route::resource('compras/ingreso','IngresoController');
Route::put('compras/ingreso/update/{id}','IngresoController@update')->name('compras.ingreso.update');
Route::get('compras/ingreso/{id}','IngresoController@show')->name('compras.ingreso.show');
Route::get('compras/ingreso/destroy/{id}','IngresoController@destroy')->name('compras.ingreso.destroy');

//creamos una ruta resource con almacen y categoria para q sea manejado por el controlador categoria