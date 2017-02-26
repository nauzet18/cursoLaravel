<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Se establece el recurso book y se crean todas las rutas acorde al CRUD
Route::resource('book', 'BookController');
//una nueva ruta para eliminar registros con el metodo get
Route::get('book/destroy/{id}', ['as' => 'book/destroy', 'uses'=>'BookController@destroy']);
//una nueva ruta para restaruar un un registro eliminado
Route::get('book/restore/{id}', ['as' => 'book/restore', 'uses'=>'BookController@restore']);
//ruta para realizar busqueda de registros.
Route::post('book/search', ['as' => 'book/search', 'uses'=>'BookController@search']);

Route::resource('author', 'AuthorController');
//una nueva ruta para eliminar registros con el metodo get
/* NOTA: resource ya trae una ruta para el destroy. Pero va con el metodo DELETE, que los 
   navegadores no soportan de base. Y se emula haciendo una peticion con el metodo POST
   pero añadiento un input _method = DELETE, para emularlo.
   Esto hace que si quieres poner un boton, tienes que hacerlo con un formulario.
   Y esto es una lata para maquetarlo.
*/
Route::get('author/destroy/{id}', ['as' => 'author/destroy', 'uses'=>'AuthorController@destroy']);
//una nueva ruta para restaruar un un registro eliminado
Route::get('author/restore/{id}', ['as' => 'author/restore', 'uses'=>'AuthorController@restore']);
//ruta para realizar busqueda de registros.
Route::post('author/search', ['as' => 'author/search', 'uses'=>'AuthorController@search']);


Route::get('home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
