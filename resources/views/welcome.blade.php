@extends('layouts.app')

@section('content')

<style>
	.swiper-container{width: 100%; height: 100%;}
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>
  <!-- Swiper -->
  <section>
	<div class="container" style="margin-top: 100px;margin-bottom: 100px;">
		<h1 class="text-center mt-5">Tu próxima casa, hoy</h1>
		<h6 class="text-center text-secondary mt-3" style="font-weight: 100">~ Mas de 10 años en el mercado inmobiliario acompañando a nuestros clientes ~</h6>
		<form method="POST" action="/busqueda">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="input-group mb-3 search-box mt-4">
			<div class="input-group-prepend">
				<select id="category" name="category_id" class="form-control" >
					<option selected value="no">OPERACIÓN</option>	
					@if(isset($categories))
				@foreach($categories as $category)				
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endforeach
				@endif
				</select>
			</div>
			<div class="input-group-prepend">			
				<select id="subcategory" name="subcategory_id" class="form-control">
					<option value="no" selected>PROPIEDAD</option>
				</select>
			  </div>
			<button type="submit" class="form-control btn btn-info" style="background-color: #d33323;
			border-color: #e8885f;"><i class="fa fa-search" aria-hidden="true"></i></button>			
		  </div>
		</form>
	</div>
	
	</section>

	@if(isset($tasaciones))
	@if($tasaciones == true)
	<section>
		<div class="card text-center">	
			<div class="card-body">	
			<p class="text-secondary">Tasamos tu propiedad con métodos y coeficientes profesionales. Realizando un estudio exhaustivo del mercado inmobiliario, entregando un informe preciso con los resultados obtenidos.</p>
			<p><a href="#" class="btn btn-success">Contactar al Whatsapp</a></p>
			<p class="text-secondary">Grupo Silguero Inmibiliaria.</p>
			<p class="text-secondary">Reg 3255</p>
			</div>
		</div>
	</section>
	@endif
	@endif
 
  <section>
	  <div class="container" style="margin-top: 20px;">
		<h2 class="text-center mt-5">Últimas propiedades</h2>
		  <h6 class="text-center text-secondary mt-3" style="font-weight: 100">A continuación se mostrarán las últimas propiedades publicadas por <strong>Silguero Propiedades</strong>. Ante cualquier duda contactenos. </h6>
		  <div class="row mt-4">
			  @foreach($products as $product)
			  <div class="col-md-4 mt-2">
				  <div class="card">
					<div class="swiper-container s2">
						<div class="swiper-wrapper">														
							@if($product->img1)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img1}}"></div>
							@endif
							@if($product->img2)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img2}}"></div>	
							@endif
							@if($product->img3)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img3}}"></div>									
							@endif
							{{--
							@if($product->img4)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img4}}"></div>										
							@endif
							@if($product->img5)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img5}}"></div>										
							@endif
							@if($product->img6)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img6}}"></div>										
							@endif
							@if($product->img7)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img7}}"></div>										
							@endif
							@if($product->img8)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img8}}"></div>										
							@endif
							@if($product->img9)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img9}}"></div>										
							@endif
							@if($product->img10)
							<div class="swiper-slide"><img style="width:100%" src="/img-products/{{$product->img10}}"></div>										
							@endif
							--}}						  						 
						</div>
						<!-- Add Pagination -->
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next" style="color: rgb(118, 118, 118);"></div>
						<div class="swiper-button-prev" style="color: rgb(118, 118, 118);"></div>
					  </div>  					
					<div class="card-body text-left">					
					<p class="text-product-title"><a style="color: #686868;" href="/product?product_id={{$product->id}}">{{$product->direccion}}</a></p>
					<h6 style="font-weight: 400; margin: 0px;">
						@if(isset($subcategories))
						@foreach($subcategories as $subcategory)
						@if($subcategory->id == $product->subcategory_id)
							{{$subcategory->name}}
						@endif
					@endforeach
					@endif - 
					@if(isset($categories))
					@foreach($categories as $category)
					@if($category->id == $product->category_id)
						{{$category->name}}
					@endif
				@endforeach
				@endif
					</h6>
					<h6 style="font-weight: 400; margin: 0px;">{{$product->barrio}}, Mar del Plata</h6>
					<h6 style="font-weight: 400; margin: 0px;">{{$product->ambientes}} Ambientes - {{$product->metros}} M&sup2;</h6>
					</div>
					
				  </div>
			  </div>
			  @endforeach			
			
		  </div>
	  </div>
  </section>


  <script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>

  <script>
  
	jQuery(document).ready(function(){
	$('#category').on('change', function(){    
	  var category_id = $(this).val();    
	$.get('subcategories', {category_id: category_id}, function(subcategories){      
	  $('#subcategory').empty();
	  $('#subcategory').append("<option value='no' selected>PROPIEDAD</option>");
	$.each(subcategories, function(index, subcategory){		
		$('#subcategory').append("<option value= '"+ subcategory.id +"'>"+ subcategory.name +"</option>");                  
	})
  });
  });
  });
  </script>
@endsection