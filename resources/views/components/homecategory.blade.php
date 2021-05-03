<div class="container">   
	<h2> {{ $filtro }} </h2>
    <div class="well">
        <div id="slideCarousel{{ $numerin }}" class="carousel slide">
            <ul class="carousel-indicators">
                <li data-target="#slideCarousel{{ $numerin }}" data-slide-to="0" class="active"></li>
                <li data-target="#slideCarousel{{ $numerin }}" data-slide-to="1"></li>
	        </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <div class="row">

                        <?php
                            if( $filtro == "Lo Más Reciente"){
                                $query =  DB::table('notas')->orderBy('fecha', 'desc')->limit(4)->get();
                            }
                            if($filtro == "Lo Más Popular"){
                                $query =  DB::table('notas')->orderBy('visitas', 'desc')->limit(4)->get();
                            }
                            if($filtro == "Lo Mejor Recibido"){
                               $query =  DB::table('notas')->orderBy('calificación', 'desc')->limit(4)->get();
                            }
                            foreach ($query as $query){
                                $idNota = $query->idNota;
                                $idCategoria = $query->categoria;
                                $cuerpo = $query->cuerpo;
                                $titulo = $query->titulo;
                                $idAutor = $query->autor;
                                $fecha = $query->fecha;
                                $vistas = $query->visitas;
                                $calificacion = $query->calificación;
                                $body = str_limit($cuerpo, 100);
                                $img = $query->img;

                                //$query2 = DB::table('usuario')->where(['idUsuario'=>$idAutor])->get();

                                //$autor = $query2->nombre;
                                //$apellido = $query2->apellido;

                                $query3 = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();
                                foreach($query3 as $query3){
                                    $categoria = $query3->nombre;
                                }
                            ?>
			
				            @component('components.homecard')
					            @slot('imagen', $img)
					            @slot('idnoticia', $idNota)
					            @slot('categoria',$categoria)
                                @slot('fecha', $fecha)
					            @slot('cabecera', $titulo)
					            @slot('contenido', $body)
                                @slot('votos', $calificacion)
                                @slot('vistas', $vistas)
				            @endcomponent
			
                            <?php
                                }
                            ?>
                        </div>        
                </div>
                <div class="carousel-item">
                <div class="row">

                        <?php
                            if( $filtro == "Lo Más Reciente"){
                                $query =  DB::table('notas')->orderBy('fecha', 'desc')->offset(4)->limit(4)->get();
                            }
                            if($filtro == "Lo Más Popular"){
                                $query =  DB::table('notas')->orderBy('visitas', 'desc')->offset(4)->limit(4)->get();
                            }
                            if($filtro == "Lo Mejor Recibido"){
                               $query =  DB::table('notas')->orderBy('calificación', 'desc')->offset(4)->limit(4)->get();
                            }
                            foreach ($query as $query){
                                $idNota = $query->idNota;
                                $idCategoria = $query->categoria;
                                $cuerpo = $query->cuerpo;
                                $titulo = $query->titulo;
                                $idAutor = $query->autor;
                                $fecha = $query->fecha;
                                $vistas = $query->visitas;
                                $calificacion = $query->calificación;
                                $body = str_limit($cuerpo, 100);

                                //$query2 = DB::table('usuario')->where(['idUsuario'=>$idAutor])->get();

                                //$autor = $query2->nombre;
                                //$apellido = $query2->apellido;

                                $query3 = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();
                                foreach($query3 as $query3){
                                    $categoria = $query3->nombre;
                                }
                            ?>
			
				            @component('components.homecard')
					            @slot('imagen', 'usuario')
					            @slot('idnoticia', $idNota)
					            @slot('categoria',$categoria)
                                @slot('fecha', $fecha)
					            @slot('cabecera', $titulo)
					            @slot('contenido', $body)
                                @slot('votos', $calificacion)
                                @slot('vistas', $vistas)
				            @endcomponent
			
                            <?php
                                }
                            ?>
                        </div>        
                </div>          
            </div>  

            <a class="carousel-control-prev carousel-control-left" href="#slideCarousel{{ $numerin }}" data-slide="prev">
		<span class="carousel-control-prev-icon" style="color: black; font-size: 4em;"><i class="fas fa-chevron-left"></i></span>
	</a>
	<a class="carousel-control-next carousel-control-right" href="#slideCarousel{{ $numerin }}" data-slide="next">
		<span class="carousel-control-next-icon" style="color: black; font-size: 4em;"><i class="fas fa-chevron-right"></i></span>
	</a>
            

        </div>
    </div>
	<hr class="my-4 negro">
</div>