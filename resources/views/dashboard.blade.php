@extends('layouts.app')

@section('content')

<?php 
    if(session()->has('success')){        ?>

        <script>
			swal({
  			title: "¡Felicitaciones tu pedido ya se está preparando!",
  			text: "Le Femme Grand Crew ah recibido tu pedido y ya lo está preparando, seguí acá el estado de tus compras. Muchas gracias por elegirnos.",
  			icon: "success",
  			button: "Gracias",
			});
        </script>
         <?php session()->forget('success'); ?>
         <?php session()->forget('carrito'); ?>
<?php }if(session()->has('pending')){ ?> 
    <script>
        swal({
          title: "¡Pago Pendiente!",
          text: "Muy bien, haz generado la boleta de pago, por favor, aboná la boleta en efectivo y avísanos cuando lo hayas echo.Recuerda que el producto es despachado una vez acreditado el pago.",
          icon: "warning",
          button: "Gracias",
        });        
    </script>
    <?php session()->forget('pending'); ?>
<?php }if(session()->has('failure')){ ?> 
    <script>
        swal({
          title: "¡Pago Rechazado!",
          text: "Por alguna razón, tu pago fue rechazado. De ser un error ponte el contacto por whatsapp o intenta nuevamente.",
          icon: "error",
          button: "Gracias",
        });
    </script>
    <?php session()->forget('failure'); ?>
<?php } ?>


<style>
/* -------------------------------- 

Primary style

-------------------------------- */
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);
*, *::after, *::before {
  box-sizing: border-box;
}

html {
  font-size: 62.5%;
}

body {
  font-size: 1.6rem;
  font-family: "Source Sans Pro", sans-serif;
  color: #383838;
  background-color: #f8f8f8;
}

a {
  color: #7b9d6f;
  text-decoration: none;
}

/* -------------------------------- 

Main Components 

-------------------------------- */
.cd-horizontal-timeline {
  opacity: 0;
  margin: 2em auto;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  transition: opacity 0.2s;
}
.cd-horizontal-timeline::before {
  /* never visible - this is used in jQuery to check the current MQ */
  content: 'mobile';
  display: none;
}
.cd-horizontal-timeline.loaded {
  /* show the timeline after events position has been set (using JavaScript) */
  opacity: 1;
}
.cd-horizontal-timeline .timeline {
  position: relative;
  height: 100px;
  width: 90%;
  max-width: 800px;
  margin: 0 auto;
}

.cd-horizontal-timeline .events-wrapper::before {
  left: 0;
  background-image: -webkit-linear-gradient( left , #f8f8f8, rgba(248, 248, 248, 0));
  background-image: linear-gradient(to right, #f8f8f8, rgba(248, 248, 248, 0));
}
.cd-horizontal-timeline .events-wrapper::after {
  right: 0;
  background-image: -webkit-linear-gradient( right , #f8f8f8, rgba(248, 248, 248, 0));
  background-image: linear-gradient(to left, #f8f8f8, rgba(248, 248, 248, 0));
}
.cd-horizontal-timeline .events {
  /* this is the grey line/timeline */
  position: absolute;
  z-index: 1;
  left: 0;
  top: 49px;
  height: 2px;
  /* width will be set using JavaScript */
  background: #dfdfdf;
  -webkit-transition: -webkit-transform 0.4s;
  -moz-transition: -moz-transform 0.4s;
  transition: transform 0.4s;
}
.cd-horizontal-timeline .filling-line {
  /* this is used to create the green line filling the timeline */
  position: absolute;
  z-index: 1;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  background-color: #7b9d6f;
  -webkit-transform: scaleX(0);
  -moz-transform: scaleX(0);
  -ms-transform: scaleX(0);
  -o-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transform-origin: left center;
  -moz-transform-origin: left center;
  -ms-transform-origin: left center;
  -o-transform-origin: left center;
  transform-origin: left center;
  -webkit-transition: -webkit-transform 0.3s;
  -moz-transition: -moz-transform 0.3s;
  transition: transform 0.3s;
}
.cd-horizontal-timeline .events a {
  position: absolute;
  bottom: 0;
  z-index: 2;
  text-align: center;
  font-size: 1.3rem;
  padding-bottom: 15px;
  color: #383838;
  /* fix bug on Safari - text flickering while timeline translates */
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
}
.no-touch .cd-horizontal-timeline .events a:hover::after {
  background-color: #7b9d6f;
  border-color: #7b9d6f;
}
.cd-horizontal-timeline .events a.selected {
  pointer-events: none;
}
.cd-horizontal-timeline .events a.selected::after {
  background-color: #7b9d6f;
  border-color: #7b9d6f;
}
.cd-horizontal-timeline .events a.older-event::after {
  border-color: #7b9d6f;
}
@media only screen and (min-width: 1100px) { 
  .cd-horizontal-timeline::before {
    /* never visible - this is used in jQuery to check the current MQ */
    content: 'desktop';
  }
}

.cd-timeline-navigation a {
  /* these are the left/right arrows to navigate the timeline */
  position: absolute;
  z-index: 1;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  height: 34px;
  width: 34px;
  border-radius: 50%;
  border: 2px solid #dfdfdf;
  /* replace text with an icon */
  overflow: hidden;
  color: transparent;
  text-indent: 100%;
  white-space: nowrap;
  -webkit-transition: border-color 0.3s;
  -moz-transition: border-color 0.3s;
  transition: border-color 0.3s;
}
.cd-timeline-navigation a::after {
  /* arrow icon */
  content: '';
  position: absolute;
  height: 16px;
  width: 16px;
  left: 50%;
  top: 50%;
  bottom: auto;
  right: auto;
  -webkit-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -ms-transform: translateX(-50%) translateY(-50%);
  -o-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
  background: url(../img/cd-arrow.svg) no-repeat 0 0;
}
.cd-timeline-navigation a.prev {
  left: 0;
  -webkit-transform: translateY(-50%) rotate(180deg);
  -moz-transform: translateY(-50%) rotate(180deg);
  -ms-transform: translateY(-50%) rotate(180deg);
  -o-transform: translateY(-50%) rotate(180deg);
  transform: translateY(-50%) rotate(180deg);
}
.cd-timeline-navigation a.next {
  right: 0;
}
.no-touch .cd-timeline-navigation a:hover {
  border-color: #7b9d6f;
}
.cd-timeline-navigation a.inactive {
  cursor: not-allowed;
}
.cd-timeline-navigation a.inactive::after {
  background-position: 0 -16px;
}
.no-touch .cd-timeline-navigation a.inactive:hover {
  border-color: #dfdfdf;
}

.cd-horizontal-timeline .events-content {
  position: relative;
  width: 100%;
  margin: 2em 0;
  overflow: hidden;
  -webkit-transition: height 0.4s;
  -moz-transition: height 0.4s;
  transition: height 0.4s;
}
.cd-horizontal-timeline .events-content li {
  position: absolute;
  z-index: 1;
  width: 100%;
  left: 0;
  top: 0;
  -webkit-transform: translateX(-100%);
  -moz-transform: translateX(-100%);
  -ms-transform: translateX(-100%);
  -o-transform: translateX(-100%);
  transform: translateX(-100%);
  padding: 0 5%;
  opacity: 0;
  -webkit-animation-duration: 0.4s;
  -moz-animation-duration: 0.4s;
  animation-duration: 0.4s;
  -webkit-animation-timing-function: ease-in-out;
  -moz-animation-timing-function: ease-in-out;
  animation-timing-function: ease-in-out;
}
.cd-horizontal-timeline .events-content li.selected {
  /* visible event content */
  position: relative;
  z-index: 2;
  opacity: 1;
  -webkit-transform: translateX(0);
  -moz-transform: translateX(0);
  -ms-transform: translateX(0);
  -o-transform: translateX(0);
  transform: translateX(0);
}
.cd-horizontal-timeline .events-content li.enter-right, .cd-horizontal-timeline .events-content li.leave-right {
  -webkit-animation-name: cd-enter-right;
  -moz-animation-name: cd-enter-right;
  animation-name: cd-enter-right;
}
.cd-horizontal-timeline .events-content li.enter-left, .cd-horizontal-timeline .events-content li.leave-left {
  -webkit-animation-name: cd-enter-left;
  -moz-animation-name: cd-enter-left;
  animation-name: cd-enter-left;
}
.cd-horizontal-timeline .events-content li.leave-right, .cd-horizontal-timeline .events-content li.leave-left {
  -webkit-animation-direction: reverse;
  -moz-animation-direction: reverse;
  animation-direction: reverse;
}
.cd-horizontal-timeline .events-content li > * {
  max-width: 800px;
  margin: 0 auto;
}
.cd-horizontal-timeline .events-content h2 {
  font-weight: bold;
  font-size: 2.6rem;
  font-family: "Playfair Display", serif;
  font-weight: 700;
  line-height: 1.2;
}
.cd-horizontal-timeline .events-content em {
  display: block;
  font-style: italic;
  margin: 10px auto;
}
.cd-horizontal-timeline .events-content em::before {
  content: '- ';
}
.cd-horizontal-timeline .events-content p {
  font-size: 1.4rem;
  color: #959595;
}
.cd-horizontal-timeline .events-content em, .cd-horizontal-timeline .events-content p {
  line-height: 1.6;
}
@media only screen and (min-width: 768px) {
  .cd-horizontal-timeline .events-content h2 {
    font-size: 7rem;
  }
  .cd-horizontal-timeline .events-content em {
    font-size: 2rem;
  }
  .cd-horizontal-timeline .events-content p {
    font-size: 1.8rem;
  }
}

@-webkit-keyframes cd-enter-right {
  0% {
    opacity: 0;
    -webkit-transform: translateX(100%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0%);
  }
}
@-moz-keyframes cd-enter-right {
  0% {
    opacity: 0;
    -moz-transform: translateX(100%);
  }
  100% {
    opacity: 1;
    -moz-transform: translateX(0%);
  }
}
@keyframes cd-enter-right {
  0% {
    opacity: 0;
    -webkit-transform: translateX(100%);
    -moz-transform: translateX(100%);
    -ms-transform: translateX(100%);
    -o-transform: translateX(100%);
    transform: translateX(100%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -ms-transform: translateX(0%);
    -o-transform: translateX(0%);
    transform: translateX(0%);
  }
}
@-webkit-keyframes cd-enter-left {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-100%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0%);
  }
}
@-moz-keyframes cd-enter-left {
  0% {
    opacity: 0;
    -moz-transform: translateX(-100%);
  }
  100% {
    opacity: 1;
    -moz-transform: translateX(0%);
  }
}
@keyframes cd-enter-left {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-100%);
    -moz-transform: translateX(-100%);
    -ms-transform: translateX(-100%);
    -o-transform: translateX(-100%);
    transform: translateX(-100%);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0%);
    -moz-transform: translateX(0%);
    -ms-transform: translateX(0%);
    -o-transform: translateX(0%);
    transform: translateX(0%);
  }
}

.circle-gris-pendiente{
  content: '';position: absolute;left: 5px;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                          bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #dfdfdf;background-color: #f8f8f8;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
.circle-green-selected-pendiente{
  content: '';position: absolute;left: 5px;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                          bottom: -7px;height: 16px;width: 17px;border-radius: 50%;border: 2px solid #1c7239;background-color: #ffffff;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
.circle-green-pendiente{
  content: '';position: absolute;left: 5px;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                          bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #1c7239;background-color: #1c7239;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}

.circle-gris-pagado{
        content: '';position: absolute;left: 35%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                                bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #dfdfdf;background-color: #f8f8f8;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
      }
      .circle-green-pagado{
        content: '';position: absolute;left: 35%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                                bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #1c7239;background-color: #1c7239;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
      }
      .circle-green-selected-pagado{
        content: '';position: absolute;left: 35%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
        bottom: -7px;height: 16px;width: 17px;border-radius: 50%;border: 2px solid #1c7239;background-color: #ffffff;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
      }


.circle-gris-enviado{
  content: '';position: absolute;left: 65%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                          bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #dfdfdf;background-color: #f8f8f8;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
.circle-green-enviado{
  content: '';position: absolute;left: 65%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
  bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #1c7239;background-color: #1c7239;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
.circle-green-selected-enviado{
  content: '';position: absolute;left: 70%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
  bottom: -7px;height: 16px;width: 17px;border-radius: 50%;border: 2px solid #1c7239;background-color: #ffffff;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}

.circle-gris-entregado{
  content: '';position: absolute;left: 100%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                          bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #dfdfdf;background-color: #f8f8f8;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
.circle-green-entregado{
  content: '';position: absolute;left: 0;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
                                          bottom: -5px;height: 12px;width: 12px;border-radius: 50%;border: 2px solid #dfdfdf;background-color: #f8f8f8;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
.circle-green-selected-entregado{
  content: '';position: absolute;left: 99%;right: auto;-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);                           transform: translateX(-50%);
  bottom: -7px;height: 16px;width: 17px;border-radius: 50%;border: 6px solid #1c7239;background-color: #1c7239;-webkit-transition: background-color 0.3s, border-color 0.3s;-moz-transition: background-color 0.3s, border-color 0.3s;transition: background-color 0.3s, border-color 0.3s;
}
    </style>


<div class="container mt-2">        
            @foreach(Auth::user()->pedidos as $pedido)     
            <div class="card mb-2">
                <div class="card-header">
                    Pedido N°{{$pedido->id}} 
                </div>
                <div class="card-body text-center">                           
                    
                    <section class="cd-horizontal-timeline" style="opacity: 1;">
                      @if($pedido->status == 'pendiente')
                        <div class="timeline">
                            <div class="events-wrapper">
                                <div class="events" style="width: 100%">
                                  
                                    <ol style="list-style-type: none;">
                                     
                                        <li><a href="#0" class="pendiente-selected text-product-price ">Pendiente <br> de pago 
                                          </a>                                          
                                          <span class="circle-green-selected-pendiente"> </span>                                                                                   
                                        </li>
                                        
                                        <li><a class="text-product-price pagado" href="#0" >En preparación</a>
                                          <span class="circle-gris-pagado"></span>
                                        </li>
                                        <li><a style="left: 62%;" href="#0" >En camino</a>
                                          <span class="circle-gris-enviado"></span>
                                        </li>
                                        <li><a style="left: 97%;" href="#0" >Entregado</a>
                                          <span class="circle-gris-entregado"></span>
                                        </li>   
                                                                                                    
                                    </ol>                    
                                    <span class="filling-line" aria-hidden="true"></span>
                                </div> <!-- .events -->
                            </div> <!-- .events-wrapper -->                                                          
                        </div> <!-- .timeline -->      
                        @endif  
                        @if($pedido->status == 'pagado')
                        <div class="timeline" style="margin-top: 100px;">
                          <div class="events-wrapper">
                              <div class="events" style="width: 100%">
                                <div class="events events-pendiente">
                                </div>
                                  <ol style="list-style-type: none;">
                                    <li><a href="#0" class="text-product-price pendiente">Pendiente <br> de pago 
                                      </a>                                          
                                      <span class="circle-green-pendiente"> </span>                                                                                   
                                    </li>
                                    
                                    <li><a class="text-product-price pagado-selected" href="#0" ><img src="img/box.png" style="height:30px;"><br>¡En preparación! <br><span class="text-product-description">El paquete se <br>está preparando...</span></a>
                                      <span class="circle-green-selected-pagado"></span>
                                    </li>
                                    <li><a style="left: 62%;" href="#0" >En camino</a>
                                      <span class="circle-gris-enviado"></span>
                                    </li>
                                    <li><a style="left: 97%;" href="#0" >Entregado</a>
                                      <span class="circle-gris-entregado"></span>
                                    </li>
                                  </ol>
                              </div>
                          </div>
                        </div>
                      @endif       
                      
                      @if($pedido->status == 'enviado')
                      <div class="timeline" style="margin-top: 100px;">
                        <div class="events-wrapper">
                            <div class="events" style="width: 100%">
                              <div class="events events-enviado">
                              </div>
                                <ol style="list-style-type: none;">
                                  <li><a style="left: -20px;" href="#0" class="text-product-price pendiente">Pendiente <br>de pago 
                                    </a>                                          
                                    <span class="circle-green-pendiente"> </span>                                                                                   
                                  </li>
                                  
                                  <li><a class="text-product-price pagado" href="#0" >En preparación</a>
                                    <span class="circle-green-pagado"></span>
                                  </li>
                                  <li><a href="#0" class="text-product-price enviando" > <img src="img/delivery-van.png" style="height:30px;"><br>¡En camino!<br><span class="text-product-description">Fecha aproximada <br>de entrega: 10/12/2020</span></a>
                                    <span class="circle-green-selected-enviado"></span>
                                  </li>
                                  <li><a style="left: 97%;" href="#0" class="text-product-price">Entregado</a>
                                    <span class="circle-gris-entregado"></span>
                                  </li>
                                </ol>
                            </div>
                        </div>
                      </div>
                    @endif
                      
                    @if($pedido->status == 'entregado')
                    <div class="timeline" style="margin-top: 100px;">
                      <div class="events-wrapper">
                          <div class="events" style="width: 100%">
                            <div class="events events-entregado">
                            </div>
                              <ol style="list-style-type: none;">
                                <li><a style="left: -20px;" href="#0" class="text-product-price pendiente">Pendiente <br>de pago 
                                  </a>                                          
                                  <span class="circle-green-pendiente"> </span>                                                                                   
                                </li>
                                
                                <li><a class="text-product-price pagado" href="#0" >En preparación</a>
                                  <span class="circle-green-pagado"></span>
                                </li>
                                <li><a href="#0" class="text-product-price enviando" style="color: rgb(34, 34, 34) !important;" >En camino</a>
                                  <span class="circle-green-enviado"></span>
                                </li>
                                <li><a href="#0" class="text-product-price entregando">¡Entregado!
                                   </a>
                                  <span class="circle-green-selected-entregado"></span>
                                </li>
                              </ol>
                          </div>
                      </div>
                    </div>
                  @endif
                    </section>


                    
                </div>
            </div>                                                                                                                                                                        
            @endforeach                    
</div>

<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>


<script>


</script>

@endsection