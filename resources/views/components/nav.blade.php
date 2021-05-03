
<!DOCTYPE html>
<html>
<meta charset = "UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta htttp-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width = device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" >
<link rel="stylesheet" type="text/css" href="assets/css/mdb.min.css" >
@yield('css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<head>
	<title>@yield('titulo')</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top nav-justified">
		<div class="container-fluid">
			<a class="col-1" href="/"><img src="../assets/imgenes/superlogo.png" class="img-fluid" width="100%" alt="Logo"> </a>
			<div>
				<div class="navbar-nav">
					<div class=" container-fluid nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="categoria" id="navbardrop" data-toggle="dropdown">
							NOTICIAS
						</a>
						<div class="dropdown-menu">
						<?php 
							$query =  DB::table('categorias')->get();
						 
							if($query->isEmpty()){
								echo 'Categorias no Encontradas';
							}
							else{
								
								foreach ($query as $query){
									if($query->idCategoria < 14){
										?>
										 <a class="dropdown-item" href="categoria?id=<?php echo $query->idCategoria ?>"><?php echo $query->nombre ?></a>
										<?php
									}
								}
							}
						?>
	                   </div>
	               </div>
	             <!--  <div class="nav-item dropdown">
	               		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	               			OPINION
	               		</a>
	               		<div class="dropdown-menu">
							<a class="dropdown-item" href="/categoria?id=0">Autor</a>
							<a class="dropdown-item" href="/categoria?id=0">Autor</a>
							<a class="dropdown-item" href="/categoria?id=0">Autor</a>
							<a class="dropdown-item" href="/categoria?id=0">Autor</a>
							<a class="dropdown-item" href="/categoria?id=0">Autor</a>

	               		</div>
	               </div> -->

	               <div class="nav-item dropdown">
	               		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	               			REPORTE CIUDADANO
	               		</a>
	               		<div class="dropdown-menu">
	               			<a class="dropdown-item" href="/categoria?id=15">Reportes</a>
							   <?php if(session()->has('id')){
								   	if(session()->get('tipo') == 2) { ?>
	               			<a class="dropdown-item" href="/publicar">Publica Algo</a>
							   <?php }
							   } ?>
	               		</div>
				   </div>
				   
				   <?php if(session()->has('id')){ ?>
				   <div class="nav-item dropdown">
	               		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
	               			USUARIO
	               		</a>
	               		<div class="dropdown-menu">
	               			<a class="dropdown-item" href="/feed">Mis Suscripciones</a>
	               			<a class="dropdown-item" href="perfil?id=<?php echo session()->get('id');?>">Perfil</a>
							   <?php if(session()->has('id')){
								   	if(session()->get('tipo') == 0 || session()->get('tipo') == 1) { ?>
	               			<a class="dropdown-item" href="/publicar">Publica Algo</a>
							   <?php }
							   } ?>
	               		</div>
				   </div>

				   <?php } ?>

	           </div>
	       </div>

	       <div class="navbar-item">
	       		<form class="form-inline my-2 my-lg-0" action="busqueda">
	       			<input class="form-control" name="action1" id="action1" type="hidden" value="general">
	       	 		<input class="form-control mr-sm-2" type="search" id="busqueda" name="busqueda" placeholder="Buscar..." aria-label="Search">
	       	 		<a href="buscar"><button class="btn btn-outline-light my-2 my-sm-0" type="button"><i class="fa fa-search"></i> Buscar</button></a>
	       		</form>
	       </div>

	       <div class="nav navbar-nav navbar-right btn-group">
		   <?php if(session()->has('id')){
			   if(session()->get('ext') == "" || is_null(session()->get('ext'))){
		    ?>
			<a href="perfil?id=<?php echo session()->get('id'); ?>" ><button type="button" class="btn btn-outline-light"><span><img class="card-img-top" src="../assets/imgenes/usuario.png" alt="Card image cap" style="max-width: 20px;"></span> <?php echo session()->get('nombre'); ?> <?php echo session()->get('apellido'); ?></button> </a>
				  <?php }
				  else {?>
			<a href="perfil?id=<?php echo session()->get('id'); ?>" ><button type="button" class="btn btn-outline-light"><span><img class="card-img-top" src="../assets/imgenes/perfil/<?php echo session()->get('id') ?>.<?php echo session()->get('ext') ?>"  onerror="this.onerror=null;this.src='assets/imgenes/usuario.png';" alt="Foto"  style="max-width: 20px;"></span> <?php echo session()->get('nombre'); ?> <?php echo session()->get('apellido'); ?></button> </a>

				  <?php } ?>
			  <a href="/logout">  <button type="button" class="btn btn-outline-light" ><span class="fa fa-user-plus"></span> Cerrar Sesión </button> </a>
		   <?php } 
		   else{ ?>
	       		<button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#login"><span class="fa fa-sign-in-alt"></span> Iniciar Sesión</button>
	            <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#registro"><span class="fa fa-user-plus"></span> Crea Una Cuenta </button>
		  <?php } ?>
 	       </div>

	       <div class="modal fade" id="login">
	       		<div class="modal-dialog">
	       			<div class="modal-content azuloscuro">
	       				<div class="modal-header azuloscuro">
	       					<h4 class="modal-title text-light">Iniciar Sesión</h4>
	       					<button type="button" class="close" data-dismiss="modal">&times;</button>
	       				</div>

	                  
	                    <div class="modal-body">
	                        <div class="row">
	                            <div class="container-fluid text-center">
	                                <form id="loginform" action="/login" method="post">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                    <div class="container">
	                                        <input class="form-control" name="action1" id="action1" type="hidden" value="login">
	                                        <input class="form-control" name="usuariologin" id="usuariologin" type="text"  placeholder="Correo">                 
	                                        <br>
	                                        <input class="form-control" name="contralogin" id="contralogin" type="password" placeholder="Contraseña">
	                                        <br>
	                                        <div class="clearfix">
	                                        	<button type="submit"  id="btnLogin" class="btn btn-outline-info btn-block"><i class="fa fa-sign-in-alt"></i> Iniciar Sesion</button>
	                                        </div>
	                                	</div>
	                                </form>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	                
	        <div class="modal fade" id="registro">
	            <div class="modal-dialog azuloscuro">
	                <div class="modal-content">	                  
	                    <div class="modal-header azuloscuro">
	                        <h4 class="modal-title text-light">Registrate</h4>
	                        <button type="button" class="close" data-dismiss="modal">&times;</button>
	                    </div>
	                  
	                    <div class="modal-body azuloscuro">
	                    	<div class="row">
	                            <div class="container-fluid text-center">
	                                <form id="registroform" action="/register"  method="post" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                                    <input class="form-control" name="action1" id="action1" type="hidden" value="registrar">
	                                    <input class="form-control" name="nombre" id="nombre" type="text" placeholder="Nombre" required>                 
	                                    <br>
	                                    <input class="form-control" name="apellido" id="apellido" type="text" placeholder="Apellido" required>                 
	                                    <br>
	                                    <input class="form-control" name="correo" id="correo" type="mail" placeholder="Correo Electrónico" required>                 
	                                    <br>
	                                    <input class="form-control" name="contra" id="contra" type="password" placeholder="Contraseña" required>
	                                    <h6 class="text-muted text-left"><small>*Minimo 8 caracteres,debe incluir una mayúsucula, una minúscula y un número</small></h6>
										<input class="form-control" name="contra" id="contra" type="password" placeholder="Repita la contraseña" required>
	                                    <div class="row text-muted">
	                                     </div>
										 <br>
										 <table class="container-fluid">
                            				<tr id='addrx'>
                                				<td>
													<div id="imgx" class="form-group">    
                                        				<div class="input-group">
															<div class="custom-file">
										 						<input type="file" class="custom-file-input" id="imgp" name="imgp"  required> 
                                                				<label class="custom-file-label text-muted" for="imgp">Seleccione una imagen</label>
															</div>
														</div>
													</div>
												</td>
                          					</tr>
                       					</table>
	                                    <button type="submit" id="btnRegistro" class="btn btn-outline-info btn-block"><i class="fa fa-user-plus"></i> Registrarse</button> 
	                                </form>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	    </div>
	</nav>


	<div class="container-fluid">    
		<div class="row content">
			<div class="col-sm-1 lado">
				
			</div>
			<div  class="col-sm-10 centro">
				@yield('content')
			</div>
			<div class="col-sm-1 lado">

			</div>
		</div>
	</div>
	@component('components.footer')

					@endcomponent

	<script src="assets/js/validacion.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/popper.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>