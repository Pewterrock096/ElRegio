<div id="carouselbanner" class="carousel slide carousel-fade" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#carouselbanner" data-slide-to="0" class="active"></li>
        <li data-target="#carouselbanner" data-slide-to="1"></li>
        <li data-target="#carouselbanner" data-slide-to="2"></li>
	</ul>

<div class="carousel-inner">
    <div class="carousel-item active">
		<div class="view">
			<img class="d-block w-100" src="../assets/imgenes/{{ $imagen }}.png" alt="First slide">
			<div class="mask rgba-black-light"></div>
			</div>
			<div class="carousel-caption">
                <h3 class="h3-responsive">{{ $cabecera }}</h3>
		 		<p>{{ $contenido }}</p>
			</div>
		</div>
		<div class="carousel-item">
			<div class="view">
				<img class="d-block w-100" src="../assets/imgenes/{{ $imagen }}.png" alt="First slide">
				<div class="mask rgba-black-strong"></div>
			</div>
			 <div class="carousel-caption">
			 	<h3 class="h3-responsive">{{ $cabecera }}</h3>
		 		<p>{{ $contenido }}</p>
			</div>
		</div>
		<div class="carousel-item">
			<div class="view">
				<img class="d-block w-100" src="../assets/imgenes/{{ $imagen }}.png" alt="First slide">
				<div class="mask rgba-black-slight"></div>
			</div>
			<div class="carousel-caption">
                <h3 class="h3-responsive">{{ $cabecera }}</h3>
		 		<p>{{ $contenido }}</p>
			</div>
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselbanner" data-slide="prev">
		<span class="carousel-control-prev-icon" style="color: black; font-size: 2em;"><i class="fas fa-chevron-left"></i></span>
	</a>
	<a class="carousel-control-next" href="#carouselbanner" data-slide="next">
		<span class="carousel-control-next-icon" style="color: black; font-size: 2em;"><i class="fas fa-chevron-right"></i></span>
	</a>
</div> 