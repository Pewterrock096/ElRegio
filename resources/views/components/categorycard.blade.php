<div class="container-fluid">   
    <div class="row">
       <div class="container">
           <div class="card flex-row flex-wrap gris">
               <div class="card-header border-0">
                   <a href="/noticia?id={{ $idnoticia }}"><img class="chico" src="assets/imgenes/nota/img/{{ $idnoticia }}.{{ $imagen }}"  onerror="this.onerror=null;this.src='assets/imgenes/usuario.png';" alt="Foto"></a>
               </div>
               <blockquote class="blockquoteblack mb-0 card-body col-md-8">
                <div class="card-block px-2">
                    <a href="/noticia?id={{ $idnoticia }}"><h4 class="card-title titulo">{{ $cabecera }}</h4></a>
                    <small class="text-light card-text">{{ $categoria }}</small>
                    <br>
                    <a href="perfil?id=0"><small class="text-light card-text">{{ $nombre }} {{ $apellido }}</small></a>
                    <br>
                    <small class="text-light card-text">{{ $fecha }}</small>
                    <p>{{ $contenido }}...</p>
                    <a href="/noticia?id={{ $idnoticia }}" class="btn btn-outline-black">CONTINUAR LEYENDO</a>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>