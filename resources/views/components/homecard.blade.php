  
    <!-- Card -->
    <div class="col-sm-3 d-flex align-items-stretch">    
      <div class="card" id="noticia">
        <!-- Card image -->
        <a href="/noticia?id={{ $idnoticia }}"><img class="card-img-top" src="../assets/imgenes/nota/img/{{ $idnoticia }}.{{ $imagen }}"  onerror="this.onerror=null;this.src='assets/imgenes/usuario.png';" alt="Foto" alt="{{ $idnoticia }}. {{$imagen}}"></a>
        <!-- Card content -->
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">{{ $categoria }}</h6>
          <h6 class="card-subtitle mb-2 text-muted">{{ $fecha }}</h6>
          <!-- Title -->
          <h4 class="card-title titulo"><a href="/noticia?id={{ $idnoticia }}">{{ $cabecera }}</a></h4>
          <!-- Text -->
          <p class="card-text">{{ $contenido }}</p>
          <!-- Button -->
          <div>
            <a href="noticia?id={{ $idnoticia }}" class="btn btn-link text-info float-left p-1 my-1 col-sm-5">Continuar Leyendo</a>
            <i class="fas fa-arrow-circle-up text-muted float-right p-1 my-1 col-sm-3" data-toggle="tooltip" data-placement="top" title="Share this post"> {{ $votos }}</i>
            <i class="fas fa-eye text-muted float-right p-1 my-1 col-sm-3" data-toggle="tooltip" data-placement="top"> {{ $vistas }}</i>
          </div>
        </div>
      </div>
    </div>
  