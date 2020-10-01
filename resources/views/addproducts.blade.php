@extends('layouts.app')
@section('content')

  <div class="card mb-3">
    <div class="card-body text-center">
      <h5 class="card-title">Ingreso de Propiedad para <strong>Silguero Propiedades</strong></h5>
      <p class="card-text text-muted"><small class="text-muted">Antes de ingresar la propiedad, tenga en cuenta que necesitará todos los datos de la misma. El proceso se realiza una sola vez. Luego podrá editarlo o eliminarlo.</small></p>
      @if(session()->has('message'))
        <div class="alert alert-success">La propiedad se <strong>cargó con éxito</strong>, puede cargar otro si desea. </div>
      @endif
      <form method="POST" action="/add" enctype="multipart/form-data">          
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">Dirección de la propiedad</label>
              <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="direccion" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
              </div>
          </div>
          <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
            <div class="col-md-6">
                <textarea type="text" class="form-control" name="description"></textarea>
            </div>
        </div>
        <div class="form-group row">
          <label for="category" class="col-md-4 col-form-label text-md-right">Categoria</label>
          <div class="col-md-6">
          <select id="category" class="form-control" name="category_id">
          <option value="">Seleccionar Categoria</option>
              @foreach($categories as $category)                
                <option value={{$category->id}}>{{$category->name}}</option>
              @endforeach
          </select>
        </div>
      </div>
      
        <div class="form-group row">        
          <label for="subcategory" class="col-md-4 col-form-label text-md-right">Subcategoría</label>
          <div class="col-md-6">
          <select id="subcategory" name="subcategory_id" class="form-control">
          </select>
        </div>
        </div>
      
        <div class="form-group row">
          <label for="color" class="col-md-4 col-form-label text-md-right">Precio Mensual</label>
          <div class="col-md-6">
              <input type="number" class="form-control" name="preciomensual" placeholder="Ejemplo: 10000">
          </div>
        </div>     
        <div class="form-group row">
          <label for="color" class="col-md-4 col-form-label text-md-right">Precio Total</label>
          <div class="col-md-6">
              <input type="number" class="form-control" name="preciototal" placeholder="Ejemplo: 10000">
          </div>
        </div>       
      
          <div class="form-group row">
              <label for="color" class="col-md-4 col-form-label text-md-right">Ambientes</label>
              <div class="col-md-6">
                  <input type="number" class="form-control" name="ambientes" placeholder="Ejemplo: 1">
              </div>
          </div>

          <div class="form-group row">
              <label for="waist" class="col-md-4 col-form-label text-md-right">Metros Cuadrados</label>
              <div class="col-md-6">
                <input id="waist" type="number" class="form-control" name="metros" required placeholder="Ejemplo: 100">
              </div>
          </div>
          <div class="form-group row">
              <label for="price" class="col-md-4 col-form-label text-md-right">Habitaciones</label>
              <div class="col-md-6">
                <input id="price" type="number" class="form-control" name="habitaciones" required placeholder="Ejemplo: 2"/>
              </div>
          </div>
          <div class="form-group row">
              <label for="stock" class="col-md-4 col-form-label text-md-right">Baños </label>
              <div class="col-md-6">
                <input id="stock" type="number" class="form-control" name="baños" required placeholder="Ejemplo: 1"/>
              </div>
          </div>
          <div class="form-group row">
              <label for="discount" class="col-md-4 col-form-label text-md-right">Barrio </label>
              <div class="col-md-6">
                <input id="discount" type="text" class="form-control" name="barrio" required placeholder="Ejemplo: Faro Norte"/>
              </div>
          </div>
          <div class="form-group row">
            <label for="discount" class="col-md-4 col-form-label text-md-right">Cochera</label>
            <div class="col-md-6">
              <input id="discount" type="text" class="form-control" name="cochera" required placeholder="Para si 1 para no 0"/>
            </div>
        </div>
          <div class="form-group row">
          <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
          <input id="file" class="btn btn-primary"name="file1" type="file" class="inputfile" />          
          </div>
          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
            <input id="file" class="btn btn-primary"name="file2" type="file" class="inputfile" />          
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="file">Suba una imagen</label>
              <input id="file" class="btn btn-primary"name="file3" type="file" class="inputfile" />          
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
                    Cargar Propiedad
                  </button>
              </div>
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
  $('#category').on('change', function(){    
    var category_id = $(this).val();    
  $.get('subcategories', {category_id: category_id}, function(subcategories){      
    $('#subcategory').empty();
  $.each(subcategories, function(index, subcategory){
      $('#subcategory').append("<option value= '"+ subcategory.id +"'>"+ subcategory.name +"</option>");                  
  })
});
});
});
</script>
@endsection