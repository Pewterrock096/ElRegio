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
    return view('home');
});

Route::get('home', function(){ 
	return view('home');
});

Route::get('inicio', function(){ 
	return view('home');
});

Route::get('noticia', function(){ 
	return view('noticia');
});

Route::get('publicar', function(){ 
	return view('publicar');
});

Route::get('categoria', function(){ 
	return view('categoria');
});

Route::get('buscar', function(){ 
	return view('busqueda');
});

Route::get('busqueda', function(){ 
	return view('busqueda');
});

Route::get('perfil', function(){ 
	return view('perfil');
});

Route::get('usuario', function(){ 
	return view('perfil');
});

Route::get('feed', function(){ 
	return view('feed');
});

Route::get('misnoticias', function(){ 
	return view('feed');
});

Route::post('login', 'logincontroller@login');

Route::post('register', 'logincontroller@registro');

Route::get('logout', 'logincontroller@logout');

Route::post('publish', 'publishcontroller@publish');

Route::get('upvote/{id}', 'noteController@upvote');

Route::get('downvote/{id}', 'noteController@downvote');

Route::get('subscribe/{id}/{nota}', 'subcontroller@subscribe');

Route::get('unsub/{id}/{nota}', 'subcontroller@unsub');

Route::get('subscribe2/{id}', 'subcontroller@subscribe2');

Route::get('unsub2/{id}', 'subcontroller@unsub2');

Route::get('comentar/{id}', 'noteController@comentar');