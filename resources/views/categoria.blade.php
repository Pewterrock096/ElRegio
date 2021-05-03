@extends('components.nav')
@section('css')
    <link rel ="stylesheet" type="text/css" href="assets/css/categoria.css" >
@endsection

<?php
         if(isset($_GET['id'])){
            $idCategoria = $_GET['id'];
            if($idCategoria == 15){
                $categoria = "Reporte Ciudadano";
            }
            else{
        $query = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();


        foreach($query as $query){
            $categoria = $query->nombre;
        } 
        
    }?>

@section('titulo')
		El Regio - <?php echo $categoria ?>
	@endsection

@section('content')
    <div class="container">
        <div class="container">

            <h1><?php echo $categoria ?></h1>
            <hr class="my-4 negro">
        </div>                                            
    </div>
    <?php  
    if(isset($_GET['page'])){
        $pag = $_GET['page'];
    }
    else{
        $pag = 1;
    }
        $resultados = 0;
        if($idCategoria == 15){
            $query2  = DB::table('notas')->where(['Reporte'=>'1'])->get();
            }
        
        else{
        $query2  = DB::table('notas')->where([
            ['categoria', '=', $idCategoria],
            ['Reporte', '=', '0']
            ])->get();
        }
    foreach($query2 as $query2){
        $resultados = $resultados + 1;
    }
    if($pag == 1){
        if($idCategoria == 15){
            $query = DB::table('notas')->where(['Reporte'=>'1'])->orderBy('fecha', 'desc')->limit(10)->get();
        }
        else{
            $query = DB::table('notas')->where([['categoria', '=', $idCategoria],['Reporte','=', '0']])->orderBy('fecha', 'desc')->offset(10*($pag-1))->limit(10)->get();
        }
    }
    else{
        if($idCategoria == 15){
            $query = DB::table('notas')->where(['Reporte'=>'1'])->orderBy('fecha', 'desc')->offset(10*($pag-1))->limit(10)->get();
        }
        else{
        $query = DB::table('notas')->where([['categoria', '=', $idCategoria],['Reporte','=', '0']])->orderBy('fecha', 'desc')->offset(10*($pag-1))->limit(10)->get();
        }
    }

        foreach($query as $query){
            $idNota = $query->idNota;
            $idCategoria = $query->categoria;
            $cuerpo = $query->cuerpo;
            $titulo = $query->titulo;
            $idAutor = $query->autor;
            $fecha = $query->fecha;
            $vistas = $query->visitas;
            $calificacion = $query->calificación;
            $body = str_limit($cuerpo, 300);
            $img = $query->img;
            $query2 = DB::table('usuario')->where(['idUsuario'=>$idAutor])->get();
            foreach ($query2 as $query2) {
                $autor = $query2->nombre;
                $autor2 = $query2->apellido;
            }
            
            $query5 = DB::table('categorias')->where(['idCategoria'=>$idCategoria])->get();


            foreach($query5 as $query5){
                $categoria = $query5->nombre;
            } 
         ?>
   	
        @component('components.categorycard')
            @slot('idnoticia', $idNota)
            @slot('imagen', $img)
            @slot('cabecera', $titulo)
            @slot('categoria', $categoria)
            @slot('nombre', $autor)
            @slot('apellido', $autor2)
            @slot('fecha', $fecha)
            @slot('contenido', $body)
	    @endcomponent       
  
        <?php } ?>

    <ul class="pagination justify-content-center">
        <?php if($pag == 1 &&  $resultados > 10){
        ?>
		<li class="page-item active"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>">1</a></li>
        <li class="page-item"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=<?php echo $pag+1 ?>"><?php echo $pag+1 ?></a></li>
		<li class="page-item"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=<?php echo $pag+1 ?>">Next</a></li>
        <?php } 
        if ($pag > 1){ 
                   ?>
        <li class="page-item"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=">Previous</a></li>
        <li class="page-item"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=<?php echo $pag-1 ?>"><?php echo $pag-1 ?></a></li>
        <li class="page-item active"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=<?php echo $pag ?>"><?php echo $pag ?></a></li>
        <?php if($pag < $resultados/10){ ?>
        <li class="page-item"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=<?php echo $pag+1 ?>"><?php echo $pag+1 ?></a></li>
		<li class="page-item"><a class="page-link" href="categoria?id=<?php echo $idCategoria?>&page=<?php echo $pag+1 ?>">Next</a></li>
        <?php
            } 
         } ?>
	</ul> 
@endsection
    <?php } ?>