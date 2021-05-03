@extends('components.nav')

    @section('css')
		<link rel ="stylesheet" type="text/css" href="assets/css/home.css" >
	@endsection

    @section('titulo')
		El Regio - Publica
    @endsection
    
    @section('content')
        <div class="container">
            <div class="container">
                <h1 class="titulo">PUBLICA UNA NOTA</h1>
                <hr class="my-4 negro">
            </div>
        </div>
        <div class="container-fluid">   
            <div class="row">
                <div class="container">
                    <form id="publicaform" action="publish" method="POST" enctype="multipart/form-data"  >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">               
                            <input class="form-control" name="action1" id="action1" type="hidden" value="publicar">
                            <label for="titulo">Titulo de la Nota:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="form-group">               
                            <label for="cuerpo">Cuerpo de la Nota:</label>
                            <textarea class="form-control" rows="10" id="cuerpo" name="cuerpo" required></textarea>
                        </div>
                        <div>
                            <label for="categoria">Categoria:</label>
                            <select class="form-control" id="categoria" name="categoria">
                                <?php 
							        $query =  DB::table('categorias')->get();
						 
							        if($query->isEmpty()){
								        echo 'Categorias no Encontradas';
							        }
							        else{
								
								        foreach ($query as $query){
									        if($query->idCategoria < 14){
										    ?>
                                                <option><?php echo $query->nombre ?></option>
										    <?php
									        }
								        }
							        }
						        ?>
                               
                            </select>
                        </div>
                        <br>            
                        <table class="container-fluid">
                            <tr id='addr0'>
                                <td>
                                    <div id="img0" class="form-group">    
                                        <label for="imagen">Agrega una Imagen:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imagen0" name="imagen0" aria-describedby="inputGroupFileAddon01" required> 
                                                <label class="custom-file-label text-muted" for="imagen0">Seleccione una imagen</label>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        </table>
<!--
                        <table class="container-fluid">
                            <tr id='addrx'>
                                <td>
                                    <div id="vid" class="form-group">    
                                        <label for="imagen">Agrega un Video:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="vid" name="vid" aria-describedby="inputGroupFileAddon01" required> 
                                                <label class="custom-file-label text-muted" for="vid">Seleccione un video</label>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                        </table> -->
                        <input class="form-control" id="numerin" name="numerin" id="action1" type="hidden" value="1">
                        <!-- <input type="button" id="addimg" class="btn btn-info btn-block" value="Agrega otra imagen">-->
                        <br>
                        <button type="submit" id="btnRegistro" class="btn btn-info btn-block"><i class="fa fa-newspaper"></i> PUBLICAR NOTA</button>
                        <br>
                        <br>
                    </form>
                </div>     
            </div>
        </div>
	@endsection