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

		@component('components.homecategory')
			@slot('filtro','Lo Más Reciente')
			@slot('numerin', 1)
		@endcomponent

		@component('components.homecategory')
			@slot('filtro','Lo Más Popular')
			@slot('numerin', 2)
		@endcomponent

		@component('components.homecategory')
			@slot('filtro','Lo Mejor Recibido')
			@slot('numerin', 3)
		@endcomponent
		

		

	@endsection