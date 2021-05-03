@extends('components.nav')

    @section('css')
		<link rel ="stylesheet" type="text/css" href="assets/css/perfil.css" >
    @endsection
    
    <?php if(isset($_GET['id'])){ 
            $idusuario = $_GET['id'];
            $query2 = DB::table('usuario')->where(['idUsuario'=>$idusuario])->get();

            foreach($query2 as $query2){
                $nombre = $query2->nombre;
                $apellido = $query2->apellido;
                $correo = $query2->correo;
                $puntos = $query2->puntos;
                $ext = $query2->ext;
            }
            $pubs = 0;
            $pubs = DB::table('notas')->where(['autor'=>$idusuario])->count();

           // foreach($query3 as $query3){
            //    $pubs = $pubs + 1;
           // }
           $puntos = DB::table('notas')->where(['autor'=>$idusuario])->sum('calificación');
            $subs = DB::table('subscripciones')->where(['usuario'=> $idusuario])->count();
        ?>
    @section('titulo')
		El Regio - <?php echo $nombre." ".$apellido ?>
	@endsection

    @section('content')
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                        <?php if ($ext == "" || is_null($ext)){
                            ?>
                            <img src="assets/imgenes/usuario.png" class="rounded" alt="Foto">
                        <?php } else { ?>
                            <img src="../assets/imgenes/perfil/<?php echo $idusuario ?>.<?php echo $ext ?>"  onerror="this.onerror=null;this.src='assets/imgenes/usuario.png';" alt="Foto" class="rounded" alt="Foto">
                        <?php } ?>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5><b><?php echo $nombre." ".$apellido ?></b></h5>
                                    <h6>Correo: <?php echo $correo ?> </h6>
                                    <br>      
                                    <h6>Publicaciones: <?php echo $pubs ?><h6>
                                    <h6>Puntuacion: <?php echo $puntos ?></h6>
                                    <h6>Seguidores: <?php echo $subs ?></h6>
                                </div>
                                <div class="card-footer">
                                <?php
                                          if(session()->has('id')){
                                            $query4 = DB::table('subscripciones')->where([ ['subscriptor', '=', session()->get('id') ], ['usuario', '=', $idusuario] ])->get();
                            
                                            if($query4->isEmpty()){
                                 ?>
                               <a href="subscribe2/<?php echo $idusuario?>"> <button type="button" class="btn btn-block btn-outline-dark"><i class="fas fa-arrow-circle-right"></i> Suscribirse</button></a>
                                            <?php }
                                            else {?>
                               <a href="unsub2/<?php echo $idusuario?>"> <button type="button" class="btn btn-block btn-outline-dark"><i class="fas fa-arrow-circle-right"></i> Desuscribirse</button></a>
                                            <?php } 
                                            }
                                            else{?>
                                            <p>
                                            <a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#login"> Inicia Sesión</a> o
	                                        <a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#registro"> Crea Una Cuenta </a>
                                            para seguir a este usuario
                                            </p>
                               <!-- <p><a>Registrate</a> o Inicia Sesión para poder suscribirte a este usuario</p> -->
                                            <?php } ?>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="container">
                <h1 class="titulo">Publicaciones</h1>
                <hr class="my-4 negro">
            </div>
        </div>
        <div class=container>
     
            <div class="row">
            <?php 
                     $query = DB::table('notas')->where(['autor'=>$idusuario])->orderBy('fecha', 'desc')->limit(12)->get();
                     foreach($query as $query){
                        $idNota = $query->idNota;
                        $idCategoria = $query->categoria;
                        $cuerpo = $query->cuerpo;
                        $titulo = $query->titulo;
                        $idAutor = $query->autor;
                        $fecha = $query->fecha;
                        $vistas = $query->visitas;
                        $calificacion = $query->calificación;
                        $body = str_limit($cuerpo, 100);

                        $query4 = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();
                        foreach($query4 as $query4){
                            $categoria = $query4->nombre;
                        }
            ?>
			
					@component('components.homecard')
						@slot('imagen', 'usuario')
						@slot('idnoticia', $idNota)
						@slot('categoria', $categoria)
                        @slot('fecha', $fecha)
						@slot('cabecera', $titulo)
						@slot('contenido', $body)
                        @slot('votos', $calificacion)
                        @slot('vistas', $vistas)
					@endcomponent
		
                     <?php } ?>
			</div>
       
        </div>
        <br>
    @endsection
    <?php } ?>