@extends('components.nav')
	@section('css')
		<link rel ="stylesheet" type="text/css" href="assets/css/home.css" >
	@endsection

	@section('titulo')
		El Regio - Suscripciones
	@endsection
   
    @section('content')
    <div class="container">   
     <h1 class="titulo">Suscripciones</h1>
    <hr class="my-4 negro">
	<?php 
	$query1 = DB::table('subscripciones')->where(['subscriptor'=>session()->get('id')])->get();
    foreach ($query1 as $query1) {
		$idautor = $query1->usuario;
		$query2 = DB::table('usuario')->where(['idUsuario'=>$idautor])->get();
		foreach ($query2 as $query2) {
			$autor = $query2->nombre;
			$autor2 = $query2->apellido;
		}

          ?>
            <h3 class="titulo"><?php echo $autor." ".$autor2 ?></h3>
            
			    <div class="row">
					<?php 
					$query3 = DB::table('notas')->where(['autor'=>$idautor])->orderBy('fecha', 'desc')->limit(4)->get();

					foreach ($query3 as $query3){
						$ext = $query3->img;
						$idNota = $query3->idNota;
                        $idCategoria = $query3->categoria;
                        $cuerpo = $query3->cuerpo;
                        $titulo = $query3->titulo;
                        $idAutor = $query3->autor;
                        $fecha = $query3->fecha;
                        $vistas = $query3->visitas;
                        $calificacion = $query3->calificación;
						$body = str_limit($cuerpo, 100);
						
						
                        $query4 = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();
                        foreach($query4 as $query4){
                            $categoria = $query4->nombre;
                        }
					?>
					    @component('components.homecard')
						    @slot('imagen', $ext)
						    @slot('idnoticia', $idNota)
						    @slot('categoria', $categoria)
							@slot ('fecha', $fecha)
						    @slot('cabecera', $titulo)
						    @slot('contenido', $body)
							@slot('votos', $calificacion)
							@slot('vistas', $vistas)
					    @endcomponent
			        
					<?php } ?>
                </div>
                <hr class="my-4 negro">
	<?php } ?>

   </div>
    @endsection