@extends('layouts.app')

@section('content')

<?php

require_once '../vendor/autoload.php';
MercadoPago\SDK::setAccessToken("TEST-997859865585449-062421-23b68fe2a8fb9a9647715b67c79ce110-216363986");
use MercadoPago\AdvancedPayments\AdvancedPayment;
$payment = new AdvancedPayment();
$preference = new MercadoPago\Preference();

//$item = new MercadoPago\Item();
$payer = new MercadoPago\Payer();
$shipment = new MercadoPago\Shipments();
$carrito = session()->get('carrito');
$arrayItems = [];
foreach(array_unique($carrito->products) as $product){  
    $item = new MercadoPago\Item();
    $count = 0;
        foreach ($carrito->products as $product1){
            if($product->name == $product1->name && $product->talle == $product1->talle && $product->color == $product1->color)
            {   $count++;  }
        }                
        if($product->promo != 0){	
        $porcentaje = 0; $price = 0;
        $porcentaje = $product->price*$product->promo; 
        $porcentaje = $porcentaje / 100;
        $price = $product->price - $porcentaje;        
        }else{
            $price = $product->price;                    
        }                                                
    $item->id = $product->id;
    $item->title = $product->name;
    $item->description = $product->description; 
    $item->picture_url = 'localhost:8001/img-products/' . $product->img1 . '';
    $item->category_id = $product->category_id;
    $item->quantity = $count; 
    $item->unit_price = $price;  
    $item->currency_id = 'ARS';        
    array_push($arrayItems, $item);    
}
$preference->items = $arrayItems;
$payer->name = $pedido->name;
$payer->email = 'asdasdds@asd.com';
$phone = array("number" => $carrito->phone);
$payer->phone = $phone;
$address = array("zip_code" => $pedido->zip_code, "street_name" => $pedido->street_name, 'street_number' => $pedido->street_number);
$ident = array("type" => "dni", "number" => $pedido->dni);
$payer->identification = $ident;
$payer->address = $address;
$shipment->mode = 'custom';

$shipment->cost = 500;
$shipment->free_shipping = false;
$preference->shipment = $shipment;
$preference->additional_info = $pedido->location;
$preference->payer = $payer;
$preference->back_urls = array(
    "success" => "http://localhost:8001/success",
    "failure" => "http://localhost:8001/failure",
    "pending" => "http://localhost:8001/pending"
);
$preference->auto_return = "approved";
$preference->external_reference = $pedido->city;
$preference->save();

?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header text-center bg-white" style="padding: 20px;">
                <h4>DETALLES DEL PAGO</h4>                
        </div>
        <form>
        <div class="card-body">    
            @if(Auth::user())

            <nav aria-label="breadcrumb" class="mt-3 mb-3">
                <ol class="breadcrumb text-product-description" style="padding: 10px;">
                  <li class="breadcrumb-item" style="font-weight: bold;"><a href="#">Carrito</a></li>
                  <li class="breadcrumb-item" style="font-weight: bold;"><a href="#">Detalles de Pago</a></li>
                  <li class="breadcrumb-item">Completado <i style="margin-top: 4px;margin-left: 5px;color: #7d7d7d;" class="fa fa-check-circle"></i></li>
                </ol>
              </nav>        
            <div class="row">
                
                
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-header">
                            TU PEDIDO
                        </div>
                        <div class="card-body" style="background: #f6f6f6">
                            <table class="table table-stripped">
                                <thead>
                                    <th class="text-product-price">PRODUCTO</th>
                                    <th class="text-product-price">TOTAL</th>
                                </thead>
                                <tbody>
                                    <?php $subtotal = 0; ?>
                                    @foreach(array_unique($carrito->products) as $product)
                                        <?php $count = 0; ?>                  
                                        @foreach ($carrito->products as $product1)
                                            @if($product->name == $product1->name && $product->talle == $product1->talle && $product->color == $product1->color)
                                                <?php $count ++ ?>                  
                                            @endif
                                        @endforeach
                                        <?php                                                                               

                                          if($product->promo != 0){					
                                                  $porcentaje = 0; $price = 0;
                                                  $porcentaje = $product->price*$product->promo; 
                                                  $porcentaje = $porcentaje / 100;
                                                  $price = $product->price - $porcentaje;
                                                  $subtotal = $subtotal + ($price*$count);
                                                  										                                                    
                                          }else{                                                                                                
                                                $price = $product->price;  
                                                $subtotal = $subtotal + ($price*$count);                                                           
                                          }    
                                        $priceTotal = $price*$count;                                                                                                                                                                                                                                                                                                                                                                                                                   
                                        $envio = 500;
                                        $total = $subtotal + $envio; 
                                        
                                        ?>
                                        <tr>
                                            <td>
                                                <h6 class="text-product-title" style="color: rgb(73, 73, 73)">{{$product->name}} <span style="color: black;font-weight: bold;font-size: 12px;">x {{$count}}</span></h5>
                                                <h6 class="text-product-description">Talle: {{$product->talle}}</h6>
                                                <h6 class="text-product-description">Color: {{$product->color}}</h6>
                                                
                                            </td>
                                            <td>
                                                <span style="font-size: 20px;" class="text-product-price">${{$priceTotal}}</span>
                                            </td>
                                              
                                        </tr>
                                        
                                    @endforeach                                    
                                </tbody>
                            </table>
                            <hr style="margin: 2px;">
                            <h6 class="text-product-price" style="color: #757575">Subtotal: <span class="text-product-price" style="float: right;font-size: 20px;">${{$subtotal}}</span></h6>
                            <hr style="margin: 2px;">                                                                     
                            <h6 class="text-product-price" style="color: #757575">Total: <span class="text-product-price" style="float: right; font-size: 20px;">${{$total}}</span></h6>                              
                            <div class="mt-4 text-center" style="width: 120%;margin-left: -27px;"><ul style="display: inline; padding-inline-start: 0px;" class="payment-icons text-center">
                                <li style="display: inline"><div class="payment-icon" style="background: #fcfcfc; padding: 0px;"><img height="32px" src="img/cards/mercado.png"></div></li>
                                <li  style="display: inline"><div class="payment-icon" style="background: #fcfcfc"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 32"> <path d="M42.667-0c-4.099 0-7.836 1.543-10.667 4.077-2.831-2.534-6.568-4.077-10.667-4.077-8.836 0-16 7.163-16 16s7.164 16 16 16c4.099 0 7.835-1.543 10.667-4.077 2.831 2.534 6.568 4.077 10.667 4.077 8.837 0 16-7.163 16-16s-7.163-16-16-16zM11.934 19.828l0.924-5.809-2.112 5.809h-1.188v-5.809l-1.056 5.809h-1.584l1.32-7.657h2.376v4.753l1.716-4.753h2.508l-1.32 7.657h-1.585zM19.327 18.244c-0.088 0.528-0.178 0.924-0.264 1.188v0.396h-1.32v-0.66c-0.353 0.528-0.924 0.792-1.716 0.792-0.442 0-0.792-0.132-1.056-0.396-0.264-0.351-0.396-0.792-0.396-1.32 0-0.792 0.218-1.364 0.66-1.716 0.614-0.44 1.364-0.66 2.244-0.66h0.66v-0.396c0-0.351-0.353-0.528-1.056-0.528-0.442 0-1.012 0.088-1.716 0.264 0.086-0.351 0.175-0.792 0.264-1.32 0.703-0.264 1.32-0.396 1.848-0.396 1.496 0 2.244 0.616 2.244 1.848 0 0.353-0.046 0.749-0.132 1.188-0.089 0.616-0.179 1.188-0.264 1.716zM24.079 15.076c-0.264-0.086-0.66-0.132-1.188-0.132s-0.792 0.177-0.792 0.528c0 0.177 0.044 0.31 0.132 0.396l0.528 0.264c0.792 0.442 1.188 1.012 1.188 1.716 0 1.409-0.838 2.112-2.508 2.112-0.792 0-1.366-0.044-1.716-0.132 0.086-0.351 0.175-0.836 0.264-1.452 0.703 0.177 1.188 0.264 1.452 0.264 0.614 0 0.924-0.175 0.924-0.528 0-0.175-0.046-0.308-0.132-0.396-0.178-0.175-0.396-0.308-0.66-0.396-0.792-0.351-1.188-0.924-1.188-1.716 0-1.407 0.792-2.112 2.376-2.112 0.792 0 1.32 0.045 1.584 0.132l-0.265 1.451zM27.512 15.208h-0.924c0 0.442-0.046 0.838-0.132 1.188 0 0.088-0.022 0.264-0.066 0.528-0.046 0.264-0.112 0.442-0.198 0.528v0.528c0 0.353 0.175 0.528 0.528 0.528 0.175 0 0.35-0.044 0.528-0.132l-0.264 1.452c-0.264 0.088-0.66 0.132-1.188 0.132-0.881 0-1.32-0.44-1.32-1.32 0-0.528 0.086-1.099 0.264-1.716l0.66-4.225h1.584l-0.132 0.924h0.792l-0.132 1.585zM32.66 17.32h-3.3c0 0.442 0.086 0.749 0.264 0.924 0.264 0.264 0.66 0.396 1.188 0.396s1.1-0.175 1.716-0.528l-0.264 1.584c-0.442 0.177-1.012 0.264-1.716 0.264-1.848 0-2.772-0.924-2.772-2.773 0-1.142 0.264-2.024 0.792-2.64 0.528-0.703 1.188-1.056 1.98-1.056 0.703 0 1.274 0.22 1.716 0.66 0.35 0.353 0.528 0.881 0.528 1.584 0.001 0.617-0.046 1.145-0.132 1.585zM35.3 16.132c-0.264 0.97-0.484 2.201-0.66 3.697h-1.716l0.132-0.396c0.35-2.463 0.614-4.4 0.792-5.809h1.584l-0.132 0.924c0.264-0.44 0.528-0.703 0.792-0.792 0.264-0.264 0.528-0.308 0.792-0.132-0.088 0.088-0.31 0.706-0.66 1.848-0.353-0.086-0.661 0.132-0.925 0.66zM41.241 19.697c-0.353 0.177-0.838 0.264-1.452 0.264-0.881 0-1.584-0.308-2.112-0.924-0.528-0.528-0.792-1.32-0.792-2.376 0-1.32 0.35-2.42 1.056-3.3 0.614-0.879 1.496-1.32 2.64-1.32 0.44 0 1.056 0.132 1.848 0.396l-0.264 1.584c-0.528-0.264-1.012-0.396-1.452-0.396-0.707 0-1.235 0.264-1.584 0.792-0.353 0.442-0.528 1.144-0.528 2.112 0 0.616 0.132 1.056 0.396 1.32 0.264 0.353 0.614 0.528 1.056 0.528 0.44 0 0.924-0.132 1.452-0.396l-0.264 1.717zM47.115 15.868c-0.046 0.264-0.066 0.484-0.066 0.66-0.088 0.442-0.178 1.035-0.264 1.782-0.088 0.749-0.178 1.254-0.264 1.518h-1.32v-0.66c-0.353 0.528-0.924 0.792-1.716 0.792-0.442 0-0.792-0.132-1.056-0.396-0.264-0.351-0.396-0.792-0.396-1.32 0-0.792 0.218-1.364 0.66-1.716 0.614-0.44 1.32-0.66 2.112-0.66h0.66c0.086-0.086 0.132-0.218 0.132-0.396 0-0.351-0.353-0.528-1.056-0.528-0.442 0-1.012 0.088-1.716 0.264 0-0.351 0.086-0.792 0.264-1.32 0.703-0.264 1.32-0.396 1.848-0.396 1.496 0 2.245 0.616 2.245 1.848 0.001 0.089-0.021 0.264-0.065 0.529zM49.69 16.132c-0.178 0.528-0.396 1.762-0.66 3.697h-1.716l0.132-0.396c0.35-1.935 0.614-3.872 0.792-5.809h1.584c0 0.353-0.046 0.66-0.132 0.924 0.264-0.44 0.528-0.703 0.792-0.792 0.35-0.175 0.614-0.218 0.792-0.132-0.353 0.442-0.574 1.056-0.66 1.848-0.353-0.086-0.66 0.132-0.925 0.66zM54.178 19.828l0.132-0.528c-0.353 0.442-0.838 0.66-1.452 0.66-0.707 0-1.188-0.218-1.452-0.66-0.442-0.614-0.66-1.232-0.66-1.848 0-1.142 0.308-2.067 0.924-2.773 0.44-0.703 1.056-1.056 1.848-1.056 0.528 0 1.056 0.264 1.584 0.792l0.264-2.244h1.716l-1.32 7.657h-1.585zM16.159 17.98c0 0.442 0.175 0.66 0.528 0.66 0.35 0 0.614-0.132 0.792-0.396 0.264-0.264 0.396-0.66 0.396-1.188h-0.397c-0.881 0-1.32 0.31-1.32 0.924zM31.076 15.076c-0.088 0-0.178-0.043-0.264-0.132h-0.264c-0.528 0-0.881 0.353-1.056 1.056h1.848v-0.396l-0.132-0.264c-0.001-0.086-0.047-0.175-0.133-0.264zM43.617 17.98c0 0.442 0.175 0.66 0.528 0.66 0.35 0 0.614-0.132 0.792-0.396 0.264-0.264 0.396-0.66 0.396-1.188h-0.396c-0.881 0-1.32 0.31-1.32 0.924zM53.782 15.076c-0.353 0-0.66 0.22-0.924 0.66-0.178 0.264-0.264 0.749-0.264 1.452 0 0.792 0.264 1.188 0.792 1.188 0.35 0 0.66-0.175 0.924-0.528 0.264-0.351 0.396-0.879 0.396-1.584-0.001-0.792-0.311-1.188-0.925-1.188z"></path> </svg></div></li>
                                <li  style="display: inline"><div class="payment-icon" style="background: #fcfcfc"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 32"> <path d="M10.781 7.688c-0.251-1.283-1.219-1.688-2.344-1.688h-8.376l-0.061 0.405c5.749 1.469 10.469 4.595 12.595 10.501l-1.813-9.219zM13.125 19.688l-0.531-2.781c-1.096-2.907-3.752-5.594-6.752-6.813l4.219 15.939h5.469l8.157-20.032h-5.501l-5.062 13.688zM27.72 26.061l3.248-20.061h-5.187l-3.251 20.061h5.189zM41.875 5.656c-5.125 0-8.717 2.72-8.749 6.624-0.032 2.877 2.563 4.469 4.531 5.439 2.032 0.968 2.688 1.624 2.688 2.499 0 1.344-1.624 1.939-3.093 1.939-2.093 0-3.219-0.251-4.875-1.032l-0.688-0.344-0.719 4.499c1.219 0.563 3.437 1.064 5.781 1.064 5.437 0.032 8.97-2.688 9.032-6.843 0-2.282-1.405-4-4.376-5.439-1.811-0.904-2.904-1.563-2.904-2.499 0-0.843 0.936-1.72 2.968-1.72 1.688-0.029 2.936 0.314 3.875 0.752l0.469 0.248 0.717-4.344c-1.032-0.406-2.656-0.844-4.656-0.844zM55.813 6c-1.251 0-2.189 0.376-2.72 1.688l-7.688 18.374h5.437c0.877-2.467 1.096-3 1.096-3 0.592 0 5.875 0 6.624 0 0 0 0.157 0.688 0.624 3h4.813l-4.187-20.061h-4zM53.405 18.938c0 0 0.437-1.157 2.064-5.594-0.032 0.032 0.437-1.157 0.688-1.907l0.374 1.72c0.968 4.781 1.189 5.781 1.189 5.781-0.813 0-3.283 0-4.315 0z"></path> </svg></div></li>
                                <li  style="display: inline"><div class="payment-icon" style="background: #fcfcfc"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 32"> <path d="M2.909 32v-17.111h2.803l0.631-1.54h1.389l0.631 1.54h5.505v-1.162l0.48 1.162h2.853l0.506-1.187v1.187h13.661v-2.5l0.253-0.026c0.227 0 0.252 0.177 0.252 0.354v2.172h7.046v-0.58c1.642 0.858 3.889 0.58 5.606 0.58l0.631-1.54h1.414l0.631 1.54h5.733v-1.464l0.858 1.464h4.596v-9.546h-4.544v1.111l-0.631-1.111h-4.672v1.111l-0.581-1.111h-6.288c-0.934 0-1.919 0.101-2.753 0.556v-0.556h-4.344v0.556c-0.505-0.454-1.187-0.556-1.843-0.556h-15.859l-1.085 2.449-1.086-2.449h-5v1.111l-0.556-1.111h-4.267l-1.97 4.52v-9.864h58.182v17.111h-3.030c-0.707 0-1.464 0.126-2.045 0.556v-0.556h-4.47c-0.631 0-1.49 0.1-1.97 0.556v-0.556h-7.98v0.556c-0.605-0.429-1.49-0.556-2.197-0.556h-5.278v0.556c-0.53-0.505-1.616-0.556-2.298-0.556h-5.909l-1.363 1.464-1.263-1.464h-8.813v9.546h8.66l1.389-1.49 1.313 1.49h5.328v-2.248h0.53c0.758 0 1.54-0.025 2.273-0.328v2.576h4.394v-2.5h0.202c0.252 0 0.303 0.026 0.303 0.303v2.197h13.358c0.733 0 1.642-0.152 2.222-0.606v0.606h4.243c0.808 0 1.667-0.076 2.399-0.429v5.773h-58.181zM20.561 13.525h-1.667v-5.354l-2.374 5.354h-1.439l-2.373-5.354v5.354h-3.334l-0.631-1.515h-3.41l-0.631 1.515h-1.768l2.929-6.843h2.424l2.778 6.49v-6.49h2.677l2.147 4.646 1.944-4.646h2.727v6.843zM8.162 10.596l-1.137-2.727-1.111 2.727h2.248zM29.727 23.020v2.298h-3.182l-2.020-2.273-2.096 2.273h-6.465v-6.843h6.565l2.020 2.248 2.071-2.248h5.227c1.541 0 2.753 0.531 2.753 2.248 0 2.752-3.005 2.298-4.874 2.298zM23.464 21.883l-1.768-1.995h-4.116v1.238h3.586v1.389h-3.586v1.364h4.015l1.868-1.995zM27.252 13.525h-5.48v-6.843h5.48v1.439h-3.839v1.238h3.738v1.389h-3.738v1.364h3.839v1.414zM28.086 24.687v-5.48l-2.5 2.702 2.5 2.778zM33.793 10.369c0.934 0.328 1.086 0.909 1.086 1.818v1.339h-1.642c-0.026-1.464 0.353-2.475-1.464-2.475h-1.768v2.475h-1.616v-6.844l3.864 0.026c1.313 0 2.701 0.202 2.701 1.818 0 0.783-0.429 1.54-1.162 1.843zM31.848 19.889h-2.121v1.743h2.096c0.581 0 1.035-0.278 1.035-0.909 0-0.606-0.454-0.833-1.010-0.833zM32.075 8.121h-2.070v1.516h2.045c0.556 0 1.086-0.126 1.086-0.783 0-0.632-0.556-0.733-1.061-0.733zM40.788 22.136c0.909 0.328 1.086 0.934 1.086 1.818v1.364h-1.642v-1.137c0-1.162-0.379-1.364-1.464-1.364h-1.743v2.5h-1.642v-6.843h3.889c1.288 0 2.677 0.228 2.677 1.844 0 0.757-0.404 1.515-1.162 1.818zM37.555 13.525h-1.667v-6.843h1.667v6.843zM39.096 19.889h-2.071v1.541h2.045c0.556 0 1.085-0.126 1.085-0.808 0-0.631-0.555-0.732-1.060-0.732zM56.924 13.525h-2.323l-3.081-5.126v5.126h-3.334l-0.657-1.515h-3.384l-0.631 1.515h-1.894c-2.248 0-3.258-1.162-3.258-3.359 0-2.298 1.035-3.485 3.359-3.485h1.591v1.491c-1.717-0.026-3.283-0.404-3.283 1.944 0 1.162 0.278 1.97 1.591 1.97h0.732l2.323-5.379h2.45l2.753 6.465v-6.465h2.5l2.879 4.747v-4.747h1.667v6.818zM48.313 25.318h-5.455v-6.843h5.455v1.414h-3.813v1.238h3.738v1.389h-3.738v1.364l3.813 0.025v1.414zM46.975 10.596l-1.111-2.727-1.137 2.727h2.248zM52.48 25.318h-3.182v-1.464h3.182c0.404 0 0.858-0.101 0.858-0.631 0-1.464-4.217 0.556-4.217-2.702 0-1.389 1.060-2.045 2.323-2.045h3.283v1.439h-3.005c-0.429 0-0.909 0.076-0.909 0.631 0 1.49 4.243-0.682 4.243 2.601 0.001 1.615-1.111 2.172-2.575 2.172zM61.091 24.434c-0.48 0.707-1.414 0.884-2.222 0.884h-3.157v-1.464h3.157c0.404 0 0.833-0.126 0.833-0.631 0-1.439-4.217 0.556-4.217-2.702 0-1.389 1.086-2.045 2.349-2.045h3.258v1.439h-2.98c-0.454 0-0.909 0.076-0.909 0.631 0 1.212 2.854-0.025 3.889 1.338v2.55z"></path> </svg></div></li>
                                <li style="display: inline"><div class="payment-icon" style="background: #fcfcfc; padding: 0px;"><img height="32px" src="img/cards/money.png"></div></li>
                               </ul>    
                            </div>            
                            <a id="pagar-btn" class="btn btn-primary mt-3 mercado-button" style="width: 100%;cursor:pointer;" >PAGAR</a>
                            <a href="#" class="btn btn-outline-secondary mt-2" style="width: 100%">AGREGAR MÁS PRODUCTOS</a>
                        </div>                     
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-info">
                Para completar el pedido debe iniciar sesión. Puede iniciar con su cuenta de <strong>Google</strong> o <strong>Facebook</strong> haciendo <a style="cursor: pointer" data-toggle="modal" data-target="#modal-login" > click aquí </a>.
            </div>
            @endif
        </div>
        <div class="card-footer">
            <span class="text-product-description">Por favor corroborar todos los datos ya que el pedido se enviara a la dirección registrada- IMPORTANTE: al seleccionar moto corroborar si la opción elegida corresponde a la localidad del domicilio. Al realizar el pedido estás aceptando nuestros <a href="#">Términos y condiciones</a> y las <a href="#">Políticas de privacidad</a> de nuestro sitio. </span>
        </div>
        </form>
    </div>
</div>

<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script>
  jQuery(document).ready(function(){
    $('#pagar-btn').on('click', function(){ 
        swal({
        title: "¿Completaste los datos correctamente?",
        text: "De ser así el sitio te llevará a la sección de Mercado Pago para abonar y de ser aprobado el pago el producto será despachado a la información solicitada. Si se encuentra en duda de algún dato, puede seguir editando cuantas veces lo requiera, ante cualquier duda ¡consulte!",
        icon: "warning",
        buttons: ["¡Seguir editando!", "Estoy seguro"],
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {  

            swal({                

                title: "¡Sólo un paso más!",
                text: "El sitio te llevará a Mercado Pago en 5 segundos para realizar el abono del pedido solicitado, el producto es despachado inmediatamente después de que se confirma el pago.",
                button: false,
                icon: "success",             
            });
            setTimeout(function(){ 
                window.location.replace("<?php echo $preference->init_point; ?>");
            }, 5000);                            
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
@endsection