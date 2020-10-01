@extends('layouts.app')

@section('content')

<div class="card mb-3">
    <div class="card-body text-center">
      <h5 class="card-title">Edicion de Propiedad para <strong>Silguero Propiedades</strong></h5>
      <p class="card-text text-muted"><small class="text-muted">Antes de Editar la propiedad, tenga en cuenta que necesitará todos los datos de la misma. El proceso se realiza una sola vez. Luego podrá editarlo o eliminarlo.</small></p>
      @if(session()->has('message'))
        <div class="alert alert-success">La propiedad se <strong>editó con éxito</strong>, puede cargar otro si desea. </div>
      @endif
      <form method="POST" action="/save" enctype="multipart/form-data">          
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{$product->id}}">
          <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">Dirección de la propiedad</label>
              <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="direccion" placeholder="{{$product->direccion}}">                
              </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
            <div class="col-md-6">
                <textarea type="text" class="form-control" name="descripcion" placeholder="{{$product->description}}"></textarea>
            </div>
        </div>                       
        <div class="form-group row">
          <label for="color" class="col-md-4 col-form-label text-md-right">Precio Mensual</label>
          <div class="col-md-6">
              <input type="number" class="form-control" name="preciomensual" placeholder="{{$product->preciomensual}}">
          </div>
        </div>     
        <div class="form-group row">
          <label for="color" class="col-md-4 col-form-label text-md-right">Precio Total</label>
          <div class="col-md-6">
              <input type="number" class="form-control" name="preciototal" placeholder="{{$product->preciototal}}">
          </div>
        </div>       
      
          <div class="form-group row">
              <label for="color" class="col-md-4 col-form-label text-md-right">Ambientes</label>
              <div class="col-md-6">
                  <input type="number" class="form-control" name="ambientes" placeholder="{{$product->ambientes}}">
              </div>
          </div>

          <div class="form-group row">
              <label for="waist" class="col-md-4 col-form-label text-md-right">Metros Cuadrados</label>
              <div class="col-md-6">
                <input id="waist" type="number" class="form-control" name="metros"  placeholder="{{$product->metros}}">
              </div>
          </div>
          <div class="form-group row">
              <label for="price" class="col-md-4 col-form-label text-md-right">Habitaciones</label>
              <div class="col-md-6">
                <input id="price" type="number" class="form-control" name="habitaciones"  placeholder="{{$product->habitaciones}}"/>
              </div>
          </div>
          <div class="form-group row">
              <label for="stock" class="col-md-4 col-form-label text-md-right">Baños </label>
              <div class="col-md-6">
                <input id="stock" type="number" class="form-control" name="baños"  placeholder="{{$product->baños}}"/>
              </div>
          </div>
          <div class="form-group row">
              <label for="discount" class="col-md-4 col-form-label text-md-right">Barrio </label>
              <div class="col-md-6">
                <input id="discount" type="text" class="form-control" name="barrio"  placeholder="{{$product->barrio}}"/>
              </div>
          </div>
          <div class="form-group row">
            <label for="discount" class="col-md-4 col-form-label text-md-right">Cochera</label>
            <div class="col-md-6">
              <input id="discount" type="text" class="form-control" name="cochera"  placeholder="{{$product->cochera}}"/>
            </div>
        </div>
          <div class="form-group row">            
          <label class="col-md-4 col-form-label text-md-right" for="file">Editar imagen 1</label>          
          <input id="file" class="btn btn-primary" name="file1" type="file" class="inputfile" /> 
          <img height="60px" src="img-products/{{$product->img1}}">         
          </div>
          <div class="form-group row">            
            <label class="col-md-4 col-form-label text-md-right" for="file">Editar imagen 2</label>            
            <input id="file" class="btn btn-primary" name="file2" type="file" class="inputfile" />          
            <img height="60px" src="img-products/{{$product->img2}}">
            </div>
            <div class="form-group row">
                
              <label class="col-md-4 col-form-label text-md-right" for="file">Editar imagen 3</label>              
              <input id="file" class="btn btn-primary" name="file3" type="file" class="inputfile" /> 
              <img height="60px" src="img-products/{{$product->img3}}">         
              </div>
              {{-- 
              <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                <input id="file" class="btn btn-primary"name="file4" type="file" class="inputfile" />          
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                  <input id="file" class="btn btn-primary"name="file5" type="file" class="inputfile" />          
                  </div>
                  <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                    <input id="file" class="btn btn-primary"name="file6" type="file" class="inputfile" />          
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                      <input id="file" class="btn btn-primary"name="file7" type="file" class="inputfile" />          
                      </div>
                      <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                        <input id="file" class="btn btn-primary"name="file8" type="file" class="inputfile" />          
                        </div>
                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                          <input id="file" class="btn btn-primary"name="file9" type="file" class="inputfile" />          
                          </div>
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
                            <input id="file" class="btn btn-primary"name="file10" type="file" class="inputfile" />          
                            </div>  --}}                        
          <div class="form-group row mb-0 mt-5">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Guardar Propiedad
                  </button>
              </div>
          </div>
      </form>

    </div>
  </div>


@endsection