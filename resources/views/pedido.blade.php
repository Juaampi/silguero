@extends('layouts.app')

@section('content')
<?php
Use App\Carrito; 
?>
@if(session()->has('carrito'))
        <?php         
            $carrito = session()->get('carrito'); 
			if(!$carrito->products){
				session()->forget('carrito');
			}
		 ?> 
@endif
        
@if(Auth::user())

<div class="container mt-3">
    <div class="card">
        <div class="card-header text-center bg-white" style="padding: 20px;">
                <h4>CONFIRMACIÓN DE PEDIDO</h4>                
        </div>
        <div class="card-body">
        <nav aria-label="breadcrumb" class="mt-3 mb-3">
            <ol class="breadcrumb" style="padding: 10px;">
              <li class="breadcrumb-item" style="font-weight: bold;"><a href="#">Carrito</a></li>
              <li class="breadcrumb-item" ><a href="#">Detalles de Pago</a></li>
              <li class="breadcrumb-item">Completado <i style="margin-top: 4px;margin-left: 5px;color: #7d7d7d;" class="fa fa-check-circle"></i></li>
            </ol>
          </nav>
          <div class="row">
              <div class="col-md-6">
                    <table class="table table-stripped no-responsive">
                        <thead>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>                            
                            @foreach(array_unique($carrito->products) as $product)
                            <tr>
                            <td>
                                <div class="row">
                                <div class="col-3">
                                    <img height="70px" style="border-radius: 5px;" src="img-products/{{$product->img1}}">
                                </div>
                                <div class="col-9">
                                <h6 class="text-product-title" style="color: rgb(73, 73, 73)">{{$product->name}}</h5>
                                <h6 class="text-product-description">Talle: {{$product->talle}}</h6>
                                <h6 class="text-product-description">Color: {{$product->color}}</h6>
                                </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-product-price">${{$product->price}}</span>
                            </td>
                            <td>             
                                <?php $count = 0; ?>                  
                                @foreach ($carrito->products as $product1)
                                    @if($product->name == $product1->name && $product->talle == $product1->talle && $product->color == $product1->color)
                                        <?php $count++; ?>                  
                                    @endif
                                @endforeach
                                <div class="row">
                                <form action="/deletetocart" method="POST"> 
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input type="hidden" value="{{$product->talle}}" name="talle">
                                    <input type="hidden" value="{{$product->color}}" name="color">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button  style="background: none;border: 1px solid gray;border-radius: 30px;" value="submit"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </form>
                                <input style="width: 40px;height: 30px;margin-left: 5px;margin-right: 5px;" type="text" value="{{$count}}" disabled class="form-control"> 
                                <form action="/addtocart" method="POST"> 
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input type="hidden" value="{{$product->talle}}" name="talle">
                                    <input type="hidden" value="{{$product->color}}" name="color">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button style="background: none;border: 1px solid gray;border-radius: 30px;" value="submit"><i  class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                    </form>    
                                </div>                            
                            </td>
                            <td>
                                @if($product->promo != 0)					
                                <?php $porcentaje = 0; $price = 0;
                                $porcentaje = $product->price*$product->promo; 
                                $porcentaje = $porcentaje / 100;
                                $price = $product->price - $porcentaje; 											
                                ?>
                                <span style="color: #bebebe; font-size: 12px;"><s>${{$product->price}}</s></span>                                
                                <span class="text-product-price">${{$price}}<span>		
                                @else
                                <span class="text-product-price">${{$product->price}}</span>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <table class="table table-stripped responsive">
                        <thead>
                            <th>Producto</th>                         
                            <th>Cantidad</th>                            
                        </thead>
                        <tbody>                            
                            @foreach(array_unique($carrito->products) as $product)
                            <tr>
                            <td>
                                <div class="row">
                                <div class="col-3">
                                    <img height="70px" style="border-radius: 5px;" src="img-products/{{$product->img1}}">
                                </div>
                                <div class="col-9">
                                <h6 class="text-product-title" style="color: rgb(73, 73, 73)">{{$product->name}}</h5>
                                <h6 class="text-product-description">Talle: {{$product->talle}}</h6>
                                <h6 class="text-product-description">Color: {{$product->color}}</h6>
                                @if($product->promo != 0)					
                                <?php $porcentaje = 0; $price = 0;
                                $porcentaje = $product->price*$product->promo; 
                                $porcentaje = $porcentaje / 100;
                                $price = $product->price - $porcentaje; 											
                                ?>
                                <span style="color: #bebebe; font-size: 12px;"><s>${{$product->price}}</s></span>                                
                                <span class="text-product-price">${{$price}}<span>		
                                @else
                                <span class="text-product-price">${{$product->price}}</span>
                                @endif
                                </div>
                                </div>
                            </td>                          
                            <td>             
                                <?php $count = 0; ?>                  
                                @foreach ($carrito->products as $product1)
                                    @if($product->name == $product1->name && $product->talle == $product1->talle && $product->color == $product1->color)
                                        <?php $count++; ?>                  
                                    @endif
                                @endforeach
                                <div class="row" style="margin-top: 20px;width: 150%;" >
                                <form action="/deletetocart" method="POST"> 
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input type="hidden" value="{{$product->talle}}" name="talle">
                                    <input type="hidden" value="{{$product->color}}" name="color">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button  style="background: none;border: 1px solid gray;border-radius: 30px;" value="submit"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </form>
                                <input style="width: 40px;height: 30px;margin-left: 5px;margin-right: 5px;" type="text" value="{{$count}}" disabled class="form-control"> 
                                <form action="/addtocart" method="POST"> 
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input type="hidden" value="{{$product->talle}}" name="talle">
                                    <input type="hidden" value="{{$product->color}}" name="color">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button style="background: none;border: 1px solid gray;border-radius: 30px;" value="submit"><i  class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                    </form>    
                                </div>                            
                            </td>                         
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form id="saved-form" action="/detalles" method="POST"> 
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
                        <p class="text-product-description" style="margin-left: 15px;margin-bottom: 10px;"  id="name">Por favor, completá todos los datos requeridos para un mejor envío.</p>                 
                            <div class="form-group" >
                                <label class="col-md-4 control-label">Nombre Completo<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="username" type="text" class="form-control" name="name" value="{{Auth::user()->name}}" required>
                                </div>		
                            </div>                         
                            <div class="form-group" >						
                                <label class="col-md-4 control-label">DNI<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="dni" type="number" class="form-control" name="dni" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Teléfono de Contacto<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="phone" type="text" class="form-control" name="phone" required>
                                </div>	
                            </div>		
                            <div class="form-group">
                                <label class="col-md-4 control-label">Dirección<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="street_name" type="text" class="form-control" name="street_name" value="{{ old('name') }}" required>
                                </div>	
                            </div>					
                            <div class="form-group">						
                                <label class="col-md-4 control-label">Altura<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="street_number" type="number" class="form-control" name="street_number" required>
                                </div>
                            </div>
                            <div class="form-group">						
                                <label class="col-md-4 control-label">Código Postal<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="zip_code" type="number" class="form-control" name="zip_code" required>
                                </div>
                            </div>
                            <div class="form-group">						
                                <label class="col-md-4 control-label">Provincia<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <select id="city" class="form-control" name="city" required>
                                        <option value="Buenos Aires">Bs. As.</option>
                                        <option value="Catamarca">Catamarca</option>
                                        <option value="Chaco">Chaco</option>
                                        <option value="Chubut">Chubut</option>
                                        <option value="Cordoba">Cordoba</option>
                                        <option value="Corrientes">Corrientes</option>
                                        <option value="Entre Rios">Entre Rios</option>
                                        <option value="Formosa">Formosa</option>
                                        <option value="Jujuy">Jujuy</option>
                                        <option value="La Pampa">La Pampa</option>
                                        <option value="La Rioja">La Rioja</option>
                                        <option value="Mendoza">Mendoza</option>
                                        <option value="Misiones">Misiones</option>
                                        <option value="Neuquen">Neuquen</option>
                                        <option value="Rio Negro">Rio Negro</option>
                                        <option value="Salta">Salta</option>
                                        <option value="San Juan">San Juan</option>
                                        <option value="San Luis">San Luis</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
                                        <option value="Santa Fe">Santa Fe</option>
                                        <option value="Sgo. del Estero">Sgo. del Estero</option>
                                        <option value="Tierra del Fuego">Tierra del Fuego</option>
                                       <option value="Tucuman">Tucuman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">						
                                <label class="col-md-4 control-label">Localidad<span style="color: red">*</span></label>
                                <div class="col-md-12">
                                    <input id="location" type="text" class="form-control" name="location" required>
                                </div>
                            </div>
    
                            <div class="form-group">						
                                <label class="col-md-4 control-label">Información adicional (Opcional)</label>
                                <div class="col-md-12">
                                    <textarea type="text" class="form-control" name="adicional"></textarea>
                                </div>
                            </div>
                        </form>
                    
            
              </div>
              <?php 
              $subtotal = 0;
              foreach($carrito->products as $product){
                if($product->promo != 0){					
                        $porcentaje = 0; $price = 0;
                        $porcentaje = $product->price*$product->promo; 
                        $porcentaje = $porcentaje / 100;
                        $price = $product->price - $porcentaje;
                        $subtotal = $subtotal + $price; 											                                                    
                }else{
                    $subtotal = $subtotal + $product->price;                    
                }
              }
              $envio = 500;
              $total = $subtotal + $envio; 
              
              ?>
              
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                        <h5 class="text-center">TOTAL DEL CARRITO</h5>
                      </div>
                      <div class="card-body">                  
                  <div style="padding: 10px 50px 10px 50px;">
                  <h6 class="text-product-description">Subtotal: <span class="text-product-price" style="float: right; font-size: 15px;">${{$subtotal}}</span></h6>
                  <hr>
                  <h6 class="text-product-description">Envío: <span class="text-product-price" style="float: right; font-size: 15px;">$500</span></h6>
                  <hr>
                  <h6 class="text-product-price">TOTAL: <span class="text-product-price" style="float: right">${{$total}}</span></h6>
                  </div>
                      </div>
                      <div class="card-footer">
                        <a id="finalizar-btn" class="btn btn-secondary" style="width: 100%">FINALIZAR COMPRA</a>
                        <a href="/" class="btn btn-outline-secondary mt-2" style="width: 100%">AGREGAR MÁS PRODUCTOS</a>
                      </div>
                  </div>

              </div>
          </div>
         
        </div>

    </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
    $('#finalizar-btn').on('click', function(){ 
        swal({
        title: "¿Completaste los datos correctamente?",
        text: "De ser así el sitio te llevará a la sección de Mercado Pago para abonar y de ser aprobado el pago el producto será despachado a la información solicitada. Si se encuentra en duda de algún dato, puede seguir editando cuantas veces lo requiera, ante cualquier duda ¡consulte!",
        icon: "warning",
        buttons: ["¡Seguir editando!", "Estoy seguro"],
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {      
            var username = $('#username').val();
            var dni = $('#dni').val();
            var phone = $('#phone').val();
            var street_name = $('#street_name').val();
            var street_number = $('#street_number').val();
            var zip_code = $('#zip_code').val();
            var city = $('#city').val();
            var location = $('#location').val();
            if(username != "" && dni != "" && phone != "" && phone != "" && street_name != "" && street_number != "" && zip_code != "" && city != "" && location != ""){
                $('#saved-form').submit();
            }else{
                swal({       
                    title: "¡Debes completar todos los campos!",                    
                text: "No olvides colocar la dirección correctamente, un número de contacto con código de área y toda la información solicitada. Es importante que completes todos los campos.", 
                button: "¡Completar!",
                });

                $('html, body').animate({
                scrollTop: $("#name").offset().top
            }, 2000);
            }
                                                                          
        }else{            
            swal({   
                  
                text: "No olvides colocar la dirección correctamente, un número de contacto con código de área y toda la información solicitada. Es importante que completes todos los campos.", 
                button: "¡Completar!",
                });

                $('html, body').animate({
                scrollTop: $("#name").offset().top
            }, 2000);
        }
        });
    });
  });
    </script>

@else

<div class="container" style>
   
    <div class="row">
        <div class="alert alert-warning">
            <div class="row" >
                <div clas="col-md-12">
                    <i style="font-size: 100px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </div>
            </div>
            Por favor, para continuar debes iniciar sesión. Lo hacemos con la intención de que puedas estar al tanto de los pedidos que haz solicitado. Gracias.
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>        
jQuery(document).ready(function(){
     $("#modal-login").modal("show");
});
</script>
@endif
@endsection