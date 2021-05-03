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
	                                <form id="registroform" action="/register"  method="post" >
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
	                                    <button type="submit" id="btnRegistro" class="btn btn-outline-info btn-block"><i class="fa fa-user-plus"></i> Registrarse</button> 
	                                </form>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>