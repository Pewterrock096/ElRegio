@extends('components.nav')
	@section('css')
		<link rel ="stylesheet" type="text/css" href="assets/css/home.css" >
	@endsection

	@section('titulo')
		El Norteño - Inicio
	@endsection

	@section('content')
		<div class="container">
			@component('components.carrousel')
				@slot('imagen', 'banner')
				@slot('cabecera', 'titulo')
				@slot('contenido', 'texto')
			@endcomponent                      
		</div>

		<div class="container">   
			<div class="row">
			@for($i = 0; $i < 16; $i++)	
					@component('components.homecard')
						@slot('imagen', 'usuario')
						@slot('idnoticia', '0')
						@slot('categoria','Categoria')
						@slot('cabecera', 'titulo')
						@slot('contenido', 'Lorem Ipsum')
					@endcomponent
			@endfor
			</div>
		</div>

		<ul class="pagination justify-content-center">
			<li class="page-item"><a class="page-link" href="#">Previous</a></li>
			<li class="page-item active"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item"><a class="page-link" href="#">Next</a></li>
		</ul> 
	@endsection