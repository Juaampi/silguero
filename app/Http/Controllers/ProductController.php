<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Carrito;
use App\Category;
use App\Pedido;
use App\Subcategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */	

	public function save(Request $request){
		$product = Product::find($request['id']);

		if(!empty($request['dolar'])){
			$product->dolar = $request['dolar'];
			$product->save();
		}

		if(!empty($request['agua'])){
			$product->agua = $request['agua'];
			$product->save();
		}

		if(!empty($request['luz'])){
			$product->luz = $request['luz'];
			$product->save();
		}

		if(!empty($request['gas'])){
			$product->gas = $request['gas'];
			$product->save();
		}

		if(!empty($request['cloacas'])){
			$product->gas = $request['cloacas'];
			$product->save();
		}

		if(!empty($request['adicional'])){
			$product->adicional = $request['adicional'];
			$product->save();
		}

		if(!empty($request['direccion'])){
			$product->direccion = $request['direccion'];
			$product->save();
		}
		if(!empty($request['descripcion'])){
			$product->description = $request['descripcion'];
			$product->save();
		}	
		if(!empty($request['preciototal'])){
			$product->preciototal = $request['preciototal'];
			$product->save();
		}	
		if(!empty($request['preciomensual'])){
			$product->preciomensual = $request['preciomensual'];
			$product->save();
		}
		if(!empty($request['ambientes'])){
			$product->ambientes = $request['ambientes'];
			$product->save();
		}
		if(!empty($request['metros'])){
			$product->metros = $request['metros'];
			$product->save();
		}
		if(!empty($request['habitaciones'])){
			$product->habitaciones = $request['habitaciones'];
			$product->save();
		}	
		if(!empty($request['baños'])){
			$product->baños = $request['baños'];
			$product->save();
		}
		if(!empty($request['barrio'])){
			$product->barrio = $request['barrio'];
			$product->save();
		}
		if(!empty($request['cochera'])){
			$product->cochera = $request['cochera'];
			$product->save();
		}
		if(!empty($request->file('file1'))){
            $file = $request->file('file1');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img1 = $name;
			$product->save();
		}

		if(!empty($request->file('file2'))){
            $file = $request->file('file2');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img2 = $name;
			$product->save();
		  }

		  if(!empty($request->file('file3'))){
            $file = $request->file('file3');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img3 = $name;
			$product->save();
		  }

		  $products = Product::all();
		  return view('list', ['products' => $products]);
	}


	public function editar(Request $request){
		$product = Product::find($request['id']);
		return view('editar',['product' => $product]);
	}

	public function delete(Request $request){
		$product = Product::find($request['id']);
		$product->delete();
		return redirect()->back()->with('success', 'success');
	}

	public function administracion(){
		$products = Product::all();
		return view('list', ['products' => $products]);
	}

	public function busqueda(Request $request){
		if(($request['category_id'] != 'no') && ($request['subcategory_id']) != 'no'){
			$products = Product::where('category_id', '=', $request['category_id'])->where('subcategory_id','=', $request['subcategory_id'])->get();
			$categories = Category::all();
			$subcategories = Subcategory::all();
			if($request['category_id'] == 3){
				$tasaciones = true;
				return view('welcome', ['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories, 'tasaciones' => $tasaciones]);			

			}else{
				return view('welcome', ['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories]);			
			}				
		}
		if(($request['category_id'] != 'no') && ($request['subcategory_id']) == 'no'){
			$products = Product::where('category_id', '=', $request['category_id'])->get();
			$categories = Category::all();
			$subcategories = Subcategory::all();
			if($request['category_id'] == 3){
				$tasaciones = true;
				return view('welcome', ['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories, 'tasaciones' => $tasaciones]);			

			}else{
				return view('welcome', ['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories]);			
			}			
		}
		if(($request['category_id'] == 'no') && ($request['subcategory_id']) != 'no'){
			$products = Product::where('subcategory_id', '=', $request['subcategory_id'])->get();
			$categories = Category::all();
			$subcategories = Subcategory::all();
			return view('welcome', ['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories]);			
		}		
	}
	public function order(){
		$carrito = new Carrito;
		$carrito = session()->get('carrito');		
		return view('order', ['carrito' => $carrito]);	
	}
	public function detalles(Request $request){
		$pedido = new Pedido;
		$pedido->zip_code = $request['zip_code'];
				$pedido->street_name = $request['street_name'];
				$pedido->street_number = $request['street_number'];
				$pedido->phone = $request['phone'];
				$pedido->dni = $request['dni'];
				$pedido->preference_id = $request['preference_id'];
				$pedido->city = $request['city'];
				$pedido->location = $request['location'];
				$pedido->adicional = $request['adicional'];	
				$pedido->name = $request['name'];
		//$carrito = new Carrito;
		$carrito = session()->get('carrito');		
		return view('detalles', ['carrito' => $carrito, 'pedido' => $pedido]);						
	}
	public function pedido(){						
		return view('pedido');
	}

	public function addtocart(Request $request)
	{
		$product = Product::find($request['product_id']);
		$product->talle = $request['talle'];
		$product->color = $request['color'];
		$carrito = new Carrito;		
		if(session()->has('carrito')){
			$carrito = session()->get('carrito');
			$arrayProducts = $carrito->products;
		}else{
			$arrayProducts = [];
		}				
		array_push($arrayProducts, $product);		
		$carrito->products = $arrayProducts;
		session()->put('carrito', $carrito);								
		return redirect()->back();
	}

	public function deletetocart(Request $request)
	{
		$product = Product::find($request['product_id']);	
		$product->talle = $request['talle'];
		$product->color = $request['color'];		
		$carrito = new Carrito;			
		if(session()->has('carrito')){
			$carrito = session()->get('carrito');
			$arrayProducts = $carrito->products;
		}else{
			$arrayProducts = [];
		}					
		for($i=0;$i<count($arrayProducts);$i++){						
				if($arrayProducts[$i]->name == $product->name && $arrayProducts[$i]->talle == $product->talle && $arrayProducts[$i]->color == $product->color){							
					//return $product;
					unset($arrayProducts[$i]);
					$arrayProducts = array_values($arrayProducts);
					break; 
				}							
		}								
		$carrito->products = $arrayProducts;
		session()->put('carrito', $carrito);								
		return redirect()->back();
	}

	public function product(Request $request)
	{
		$product = Product::find($request['product_id']);	
		$categories = Category::all();
		$subcategories = Subcategory::all();
		return view('product', ['product' => $product, 'categories' => $categories, 'subcategories' => $subcategories]);
	}
	
	public function alta()
	{
		$categories = Category::all();
		$subcategories = Subcategory::all();
		return view('addproducts', ['categories' => $categories, 'subcategories' => $subcategories]);
	}

	public function subcategories(Request $request)
    {
      
			$category_id = $request->input('category_id');			
			$subcategories = Category::find($category_id)->subcategories;						

        	return response()->json($subcategories);
		
	}

	public function addProduct(Request $request){
		$product = new Product;
		$product->direccion = $request['direccion'];
		$product->description = $request['description'];
		$product->preciototal = $request['preciototal'];
		$product->category_id = $request['category_id'];
		$product->preciomensual = $request['preciomensual'];
		$product->subcategory_id = $request['subcategory_id'];
		$product->ambientes = $request['ambientes'];		
		$product->metros = $request['metros'];	
		$product->adicional = $request['adicional'];
		$product->dolar = $request['dolar'];
		$product->cloacas = $request['cloacas'];
		$product->luz = $request['luz'];
		$product->gas = $request['gas'];
		$product->agua = $request['agua'];		

		  if($request->hasFile('file1')){
            $file = $request->file('file1');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img1 = $name;
		  }

		  if($request->hasFile('file2')){
            $file = $request->file('file2');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img2 = $name;
		  }

		  if($request->hasFile('file3')){
            $file = $request->file('file3');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img3 = $name;
		  }

		  if($request->hasFile('file4')){
            $file = $request->file('file4');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img4 = $name;
		  }

		  if($request->hasFile('file5')){
            $file = $request->file('file5');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img5 = $name;
		  }

		  if($request->hasFile('file6')){
            $file = $request->file('file6');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img6 = $name;
		  }

		  if($request->hasFile('file7')){
            $file = $request->file('file7');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img7 = $name;
		  }

		  if($request->hasFile('file8')){
            $file = $request->file('file8');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img8 = $name;
		  }

		  if($request->hasFile('file9')){
            $file = $request->file('file9');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img9 = $name;
		  }

		  if($request->hasFile('file10')){
            $file = $request->file('file10');
            $name = time().$file->getClientOriginalName();
			$file->move(public_path().'/img-products/', $name); 
			$product->img10 = $name;
		  }	
		$product->habitaciones = $request['habitaciones'];
		$product->baños = $request['baños'];
		$product->barrio = $request['barrio'];
		$product->cochera = $request['cochera'];
		$product->save();
		return redirect()->back()->with('message', 'okey');
	  }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
