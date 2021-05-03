<div class="card">
    <div class="card-header">
    <div class="row">
    <div class="col-sm-10">
        <h5 class="text-info"><b> <a href="perfil?id={{ $user }}"><img src="assets/imgenes/perfil/{{ $imagen }}.{{ $extension }}" style="max-width: 20px;" onerror="this.onerror=null;this.src='assets/imgenes/usuario.png';" alt="Foto">
        {{ $nombre }} {{ $apellido }}</a> - {{ $fecha }}</b></h5>
        </div>
       <!-- <div class="col-sm-2">
        <button class="btn btn-outline-dark btn-sm"><i  class="fas fa-reply"> Responder</i></button>
        </div> -->
    </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <h5>{{ $comentario }}</h5>
        </div>                               
    </div>
</div>
<br>