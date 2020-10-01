@extends('layouts.app')

@section('content')

<div class="container">  
<div class="row mt-2" style="font-family: 'Titillium Web', sans-serif">
    <div class=col-md-6>
      <div class="swiper-container s3">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img style="width: 100%" src="img/slider1-prueba.jpg"></div>
          <div class="swiper-slide"><img style="width: 100%" src="img/slider1-prueba.jpg"></div>                  
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next" style="color: black;"></div>
        <div class="swiper-button-prev" style="color: black;"></div>
      </div>      
    </div>
    <div class="col-md-6 mt-2">
        <div class="text-left">
          <small >@foreach($subcategories as $subcategory)
						@if($subcategory->id == $product->subcategory_id)
							{{$subcategory->name}}
						@endif
					@endforeach - 
					@foreach($categories as $category)
					@if($category->id == $product->category_id)
						{{$category->name}}
					@endif
        @endforeach - Mar del Plata</small>          
        @if($product->preciototal)
        <h4 class="text-product-title mt-2" style="color: #676767">${{$product->preciototal}}</h4> 
        @endif
        @if($product->preciomensual)
        <h4 class="text-product-title mt-2" style="color: #676767">${{$product->preciomensual}} <small class="text-danger text-sm" style="font-size: 12px;">Mensual</small></h4> 
        @endif					
					<span class="text-product-price mt-2">{{$product->direccion}}<span>		         
        <br>              
        <h6 class="text-product-description mt-3">{{$product->description}}</h6>                
        </div>                
    </div>
</div>

<div class="row" style="font-family: 'Titillium Web', sans-serif">
    <div class="col-md-12 text-center">
        <h5 class="mt-5">Información de la propiedad</h5>
        <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Ambientes</th>
                      <td>{{$product->ambientes}}</td>                   
                  </tr>
                <tr>
                  <th>Metros Cuadrados</th>
                    <td>{{$product->metros}}</td>                   
                </tr>
                <tr>
                  <th>Habitaciones</th>
                    <td>
                     {{$product->habitaciones}}           
                    </td>                      
                </tr>
                <tr>
                    <th>Baños</th>
                      <td>
                      {{$product->baños}}
                      </td>                                       
                  </tr>
                  <tr>
                    <th>Barrio</th>
                      <td>
                      {{$product->barrio}}
                      </td>                                       
                  </tr>
                  <tr>
                    <th>Adicional</th>
                      <td>
                      A metros del mar!
                      </td>                                       
                  </tr>
            </tbody>
        </table>
    </div>
</div>
<button type="button" class="btn btn-success btn-lg btn-block">Comunicarme por Whatsapp <i class="fa fa-whatsapp" aria-hidden="true"></i></button>
</div>


<script
src="https://code.jquery.com/jquery-3.5.1.min.js"
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>

<script>

jQuery(document).ready(function(){
  $('#select-talle').on('change', function(){
    if($('#select-talle').val() != 0 && $('#select-color').val() != 0){
        $('#btn-add').prop("disabled",false);
    }else{
      $('#btn-add').prop("disabled",true);
    }
  });
  $('#select-color').on('change', function(){
    if($('#select-talle').val() != 0 && $('#select-color').val() != 0){
        $('#btn-add').prop("disabled",false);
    }else{
      $('#btn-add').prop("disabled",true);
    }
  });
  
});
  </script>


@endsection