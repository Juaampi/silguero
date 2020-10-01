<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kufam:ital,wght@1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body style="background: #fafafa87">
	@if(session()->has('carrito'))
		<?php 
			$carrito = session()->get('carrito'); 
			if(!$carrito->products){
				session()->forget('carrito');
			}
		 ?> 
	@endif
	
	
	@if(session()->has('response'))	
		<script>
			swal({
  			title: "¡Bienvenido!",
  			text: "Hola, haz iniciado sesión correctamente, ahora podrás comprar y ver tus pedidos.",
  			icon: "success",
  			button: "Gracias",
			});
		</script>
		<?php session()->forget('response'); ?> 
	@endif

	
	@if(session()->has('error'))	
		<script>
			swal({
  			title: "¡Lo sentimos!",
  			text: "Ocurrió un error mientras intentabas acceder. Por favor cierra la sesión en la cuenta que estás utilizando para ingresar, o intenta nuevamente.",
  			icon: "error",
  			button: "Gracias",
			});
		</script>
		<?php session()->forget('error'); ?> 
	@endif

	<?php //session()->forget('carrito'); ?>
	{{-- <div class="top-info">ENVÍOS A TODO EL PAÍS <img class="icon-info" src="img/camion.png"></div> --}}
	<nav class="navbar navbar-expand-lg navbar-light" style="background: #fef0ac;">
		<div class="container">
		<a class="navbar-brand text-brand" href="/" ><img class="img-brand" src="img/logo.jpeg"></a>
		
		<button class="navbar-toggler" style="border:none;" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse text-center" id="navbarNavDropdown">
		  <ul class="navbar-nav">
			
			<li class="nav-item active">
			  <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Tasaciones</a>
			</li>			
			<li class="nav-item ">
			  <a class="nav-link">
				Contacto
			  </a>			  			  
			</li>
		  </ul>		  		
		</ul>
		</div>
		</div>
	  </nav>

	@yield('content')
		
		<div class="row" style="position:fixed; bottom: 5%; right :7%;z-index: 9999; " >			
			<a href="/pedido" style="padding: 8px;background: #28a745;border-radius: 70px;width: 65px;">
				<i style="font-size: 50px;margin-left: 3px;" class="fa fa-whatsapp text-white" aria-hidden="true"></i><span class="badge badge-dark" style="font-size: 15px;position: absolute;top: 0px;"></span>
			</a>
		</div>		


	<footer class="footer mt-5" style="background: #b9b2b2;">
		<div class="container text-center" style="color: #4a4747;padding: 15px 15px 15px 0px;">								
				
					<ul id="cards" class="link-footer" style="margin-bottom: -5px;">					
						<li><a>COPYRIGHT 2020 © <span class="font-weight-bold" style="color: black;">SILGUERO PROPIEDADES</span></a>
						</li>
					</ul>
					<ul id="cards" class="link-footer">					
						<li><a>TODOS LOS DERECHOS RESERVADOS</a>
						</li>
					</ul>
							
		</div>
	</footer>
	

		

	<!-- Scripts -->

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>



<script>
    var swiper = new Swiper('.s1', {
      slidesPerView: 1,
      spaceBetween: 5,      
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
	  breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 1,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 1,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 1,
        },
	  }
    });

	var newSwiper = new Swiper('.s2', {
      slidesPerView: 1,
      spaceBetween: 0,      
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },	  
	 
    });

	var productSwider = new Swiper('.s3', {
      slidesPerView: 1,
      spaceBetween: 0,      
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
	  navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },	  
	 
    });


  </script>

<div id="modal-login" class="modal fade" role="dialog">
	<div class="modal-dialog" style="top: 10%;">
  
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="modal_button">&times;</span><span class="sr-only">Close</span></button>			
		</div>
		<div class="modal-body" style="background: #f5f5f5">        
			<h4 class="modal-title mb-3 text-product-price">Hola, ¿Con qué cuenta deseas acceder?</h4>
			<h5 style="font-size: 17px;" class="text-product-description">Para poder comprar productos de <span style="color: black">Le Femme Grand Crew</span> tendrá que iniciar sesión con <span style="color: black">Facebook</span> o <span style="color: black">Google</span>. Éstas empresas nos brindan sólo su nombre, imagen de perfil, y el email de su cuenta, respetando sus <a href="https://support.google.com/accounts/answer/112802?co=GENIE.Platform%3DDesktop&hl=es">Políticas de inicio de sesión</a>. </h5>
			<div class="row mt-4">
				<div class="col-6">
					<div id="btn-google" class="google-btn">
						<div class="google-icon-wrapper">
				  			<img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
						</div>
						<p class="btn-text"><b>Acceder con Google</b></p>
			  		</div>
				</div>	
				<div class="col-6">
					<div href="#" class="google-btn" style="margin-left: -10px;" >
						<div class="google-icon-wrapper"><i class="fa fa-facebook fa-fw" style="font-size: 25px;margin-top: 8px;padding-left: 5px;color: #4285f4;"></i></div>
						<span class="btn-text" style="margin-right: 6px;font-weight: bold;">Acceder con Facebook</span>
					</div>
				</div>
			</div>
			<h5 style="font-size: 17px;" class="text-product-description mt-3">Al iniciar sesión en <span style="color:black">Le Femme Grand Crew</span> estás aceptando nuestros <a href="#">Términos y Condiciones</a> y las <a href="#">Políticas de Privacidad</a> del sitio.</h5>
		</div>
		
		<div class="modal-footer">
		  <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		</div>
	  </div>
  
	</div>
  </div>
  
<script>

	 $(document).ready(function(){
		$('#btn-google').on('click', function(){ 
			window.location.href = "/auth";
	   });
	 });

	</script>

</body>
</html>
