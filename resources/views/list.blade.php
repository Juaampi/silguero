@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <table class="table table-stripped">
        <tr>            
            <th>Dirección</th>
            <th>Descripción</th>
            <th>Precio total</th>
            <th>Precio mensual</th>
            <th>Ambientes</th>
            <th>Metros</th>
            <th>Habitaciones</th>
            <th>Baños</th>
            <th>Barrio</th>
            <th>Cochera</th>
            <th>Imagen 1</th>
            <th>Imagen 2</th>
            <th>Imagen 3</th>
            <th>Accion</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{$product->direccion}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->preciototal}}</td>
            <td>{{$product->preciomensual}}</td>
            <td>{{$product->ambientes}}</td>
            <td>{{$product->metros}}</td>
            <td>{{$product->habitaciones}}</td>
            <td>{{$product->baños}}</td>
            <td>{{$product->barrio}}</td>
            <td>{{$product->cochera}}</td>
            <td><img height="50px" src="img-products/{{$product->img1}}"></td>
            <td><img height="50px" src="img-products/{{$product->img2}}"></td>
            <td><img height="50px" src="img-products/{{$product->img3}}"></td>
            <td><form action="/editar" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="submit" class="btn btn-primary" value="editar">
            </form>  
            <form action="/delete" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="submit" class="btn btn-danger" value="eliminar">
            </form>  
            </td>
        </tr>
        @endforeach        
    </table>
</div>


@endsection