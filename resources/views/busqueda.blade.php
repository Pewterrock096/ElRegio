@extends('components.nav')
@section('css')
    <link rel ="stylesheet" type="text/css" href="assets/css/categoria.css" >
@endsection

@section('titulo')
		El Regio - Busqueda
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <h1>Busqueda: Cosa Buscada</h1>
            <hr class="my-4 negro">
        </div>                                            
    </div>

    <div class="container">
        <button class="btn btn-secondary" data-toggle="collapse" data-target="#opcionesbusqueda"><i class="fa fa-cog"></i> Opciones de Busqueda</button>
        <div id="opcionesbusqueda" class="collapse">
            <form class="form-inline my-2 my-lg-0" action="buscar" >
                <div class="row">
                    <input class="form-control" name="action1" id="action1" type="hidden" value="filter">
                    <input class="form-control" name="param" id="param" type="hidden" value="busqueda">                              
                    <div class="col-sm">   
                        <br>
                        <div class="radio">                                      
                            <input type="radio" class="form-check-input" id="FiltNombre" name="filtro" value="2" checked>Nombre del Artículo                                     
                        </div>
                        <div class="radio">                                     
                            <input type="radio" class="form-check-input " id="FiltDescripcion" name="filtro" value="3">Descripción                                     
                        </div>
                        <div class="radio">                                      
                            <input type="radio" class="form-check-input " id="FiltCategoria" name="filtro" value="1">Categoría
                            <select class="form-control" id="categorias1" name="categorias1">
                                <option>Categoria</option>                                                  
                            </select>                                     
                        </div>                               
                        <div class="radio">                         
                            <input type="radio" class="form-check-input" id="FiltUsuario" name="filtro" value="4">Usuario               
                        </div>
                        <div class="radio">                                     
                            <input type="radio" class="form-check-input " id="FiltFecha" name="filtro" value="5">Fecha
                            <label for="min">Fecha Inicial:</label>    
                            <input type="date" id="min" name="min"><br>
                            <label for="max">Fecha Final:</label>   
                            <input type="date" id="max "name="max"><br>                                     
                        </div>
                    </div>
                    <br>                              
                    <button type="submit" class="btn"><i class="fa fa-filter"></i>Filtrar Resultados</button>                            
                </div>
            </form>
        </div>                     
    </div>

    @for($i = 0; $i < 10; $i++)	
        @component('components.categorycard')
            @slot('idnoticia', '0')
            @slot('imagen', 'usuario')
            @slot('cabecera', 'Titulo')
            @slot('categoria', 'Categoria')
            @slot('nombre', 'Nombre')
            @slot('apellido', 'Apellido')
            @slot('fecha', '24/09/2019')
            @slot('contenido', 'Lorem Ipsum')
	    @endcomponent       
    @endfor

    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
		<li class="page-item active"><a class="page-link" href="#">1</a></li>
		<li class="page-item"><a class="page-link" href="#">2</a></li>
		<li class="page-item"><a class="page-link" href="#">3</a></li>
		<li class="page-item"><a class="page-link" href="#">Next</a></li>
	</ul> 
@endsection