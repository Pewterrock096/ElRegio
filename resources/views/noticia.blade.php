@extends('components.nav')

@section('css')
	<link rel ="stylesheet" type="text/css" href="assets/css/noticia.css" >
@endsection

@section('titulo')
		El Regio - Noticia
	@endsection

@section('content')
<?php 
    if(isset($_GET['id'])){
        $idNota = $_GET['id'];

        $query = DB::table('notas')->where(['idNota'=>$idNota])->get();
        foreach($query as $query){
        $idCategoria = $query->categoria;
        $cuerpo = $query->cuerpo;
        $titulo = $query->titulo;
        $idAutor = $query->autor;
        $fecha = $query->fecha;
        $calificacion = $query->calificación;
        $visitas = $query->visitas;
        $img = $query->img;
        $visitas = $visitas + 1;

        $query4 = DB::table('notas')->where(['idNota'=>$idNota])->update(['visitas'=>$visitas]);


        $query2 = DB::table('usuario')->where(['idUsuario'=>$idAutor])->get();
        foreach($query2 as $query2){
            $autor = $query2->nombre;
            $apellido = $query2->apellido;
        }

        $query3 = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();
        foreach($query3 as $query3){
            $categoria = $query3->nombre;
        }
    
?>
<div class="container">
    <div class="container">
        <h1 class="titulo"><?php echo $titulo ?></h1>   
        <a href="categoria?id=0"><h6 class="text-muted"><?php echo $categoria ?></h6></a>
        <table >
          <th><a href="perfil?id=<?php echo $idAutor ?>"><h6 class="text-muted"><?php echo $autor ?> <?php echo $apellido ?></h6></a> </th>
          <?php 
          if(session()->has('id')){
                $query4 = DB::table('subscripciones')->where([ ['subscriptor', '=', session()->get('id') ], ['usuario', '=', $idAutor] ])->get();

                if($query4->isEmpty()){
          ?>

            <th>  <a href="subscribe/<?php echo $idAutor ?>/<?php echo $idNota ?>"> <button type="button" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-right"></i> Suscribirse</button> </a></th>

                <?php }
                else{  ?>
           <th>  <a href="unsub/<?php echo $idAutor ?>/<?php echo $idNota ?>"> <button type="button" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-right"></i> Desuscribirse</button> </a></th>


          <?php 
                    }
            } ?>
        </table>
        <h6 class="text-muted"><?php echo $fecha ?></h6>
        <hr class="my-4 negro">
      
    </div>
</div>
<div class="container-fluid">   
    <div class="row">
        <div class="container">
            <div style="float:left; max-width: 40%; margin: 10px;">
                <div class="container">
                <img class="card-img-top" src="../assets/imgenes/nota/img/<?php echo $idNota ?>.<?php echo $img ?>"  onerror="this.onerror=null;this.src='assets/imgenes/banner.png';"  alt="Foto">                    
                </div>
            </div>
            <div>
                <p> 
                   <?php echo $cuerpo ?>
                </p>
                <br>
                <div style="float:right;">
                <h6>Calificación Actual: <?php echo $calificacion ?></h6>
        <p>Que te parecio esta nota? </p>
        <?php 
          if(session()->has('id')){
              ?>
        <a href="upvote/<?php echo $idNota ?>"><i  style="float:left;" class="fas fa-arrow-circle-up">Buena</i> </a>
        <a href="downvote/<?php echo $idNota ?>"><i style="float:right;" class="fas fa-arrow-circle-down">Mala</i></a>
          <?php } else{
              ?>
               <p>
                <a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#login"> Inicia Sesión</a> o
	            <a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#registro"> Crea Una Cuenta </a>
                para calificar esta nota
                </p>
          <?php } ?>
        </div>
        <h6>Visitas: <?php echo $visitas ?></h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <hr class="my-4 negro">
            <h1 class="titulo">COMENTARIOS</h1>

            <form class="form" action="comentar/<?php echo $idNota ?>" method="GET">
               <div class="container">
                   <div class="card rounded">
                       <div class="card-body negro2">
                       <?php 
          if(session()->has('id')){
              ?>
                           <div class="form-group">
                                <input class="form-control" name="param" id="param" type="hidden" value="id">
                                <h3 class="text-muted" >Deja un Comentario:</h3>
                                <textarea class="form-control" rows="5" id="Comentar" name="Comentar" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-outline-info"><i class="far fa-comment"></i> Comentar</button>
                            <?php } else{
              ?>
               <h4 class="text-light"> 
                <a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#login"> Inicia Sesión</a> o
	            <a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#registro"> Crea Una Cuenta </a>
                para comentar en esta nota
                </h4>
          <?php } ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
        <?php 
                $query5 = DB::table('comentarios')->where(['nota'=>$idNota])->get();
                foreach($query5 as $query5){
                    $iduser = $query5->usuario;
                    $comentario = $query5->comentario;
                    $fecha2 = $query5->fecha;
                    
                    $query6 = DB::table('usuario')->where(['idUsuario'=>$iduser])->get();
                    foreach($query6 as $query6){
                        $username = $query6->nombre;
                        $usersurname = $query6->apellido;
                        $extension = $query6->ext;
                    }
            
                
        ?>

                @component('components.comentario')
                    @slot('user', $iduser)
                    @slot('imagen', $iduser)
                    @slot('extension', $extension)
                    @slot('nombre', $username)
                    @slot('apellido', $usersurname)
                    @slot('fecha', $fecha2)
                    @slot('comentario', $comentario)
                @endcomponent
                <?php } ?>
        </div>
    </div>
</div>
<?php 
        }
    }
?>
@endsection