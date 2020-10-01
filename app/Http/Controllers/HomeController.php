<?php namespace App\Http\Controllers;

require_once '../vendor/autoload.php';
		
use App\Category;
use App\Subcategory;
use App\Product;
use App\Pedido;
use App\Orden;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use MercadoPago\Preference;
use MercadoPago;
MercadoPago\SDK::setAccessToken("TEST-997859865585449-062421-23b68fe2a8fb9a9647715b67c79ce110-216363986");

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::orderBy('created_at', 'desc')->get();
		$categories = Category::all();
		$subcategories = Subcategory::all();
		return view('welcome', ['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories]);
	}

	public function product()
	{
		return view('product');
	}
	public function saved(Request $request){
		
	}

	public function success(Request $request){

		if(isset($_GET['preference_id'])){
			$id = array('id' => $_GET['preference_id']);
				if(session()->has('carrito')){					
					$carrito = session()->get('carrito');
					$preference = Preference::read($id);												
					$pedido = new Pedido; 
					$pedido->user_id = Auth::user()->id;
					$pedido->status = 'pagado';
					$subtotal = 0;				
					foreach(array_unique($carrito->products) as $product){
						$count = 0;
						foreach ($carrito->products as $product1){						
							$product_local = Product::find($product1->id);
							$product_local->stock = $product_local->stock - 1;
							$product_local->save();					
						if($product->name == $product1->name && $product->talle == $product1->talle && $product->color == $product1->color){
							$count++;
						}
					}				
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
				}    		  		                                                                                                                                                                                                                                                                                                                                                                                                                   
		  		$envio = 500;
				$total = $subtotal + $envio; 
				$pedido->amount = $total;
				$payer = $preference->payer;
				$adress = $payer->address;
				$phone = $payer->phone;
				$ident = $payer->identification;
				$pedido->zip_code = $adress->zip_code;
				$pedido->street_name =$adress->street_name;
				$pedido->street_number = $adress->street_number;				
				$pedido->phone = $phone->number;
				$pedido->dni = $ident->number;
				$pedido->name = $payer->name;
				$pedido->preference_id = $request['preference_id'];
				$pedido->location = $preference->additional_info;												
				$pedido->save();			

				foreach($carrito->products as $product){
					$order = new Orden();
					$order->product_id = $product->id;
					$order->pedido_id = $pedido->id;
					$order->save(); 									
				}
				}
			}		
			session()->put('success', 'true');			
			return redirect('/dashboard');
		}	
		
	public function failure(){
		session()->put('failure', 'true');		
		return view('dashboard');
	}

	public function pending(Request $request){
		session()->put('pending', 'true');				
		if(isset($_GET['preference_id'])){
			$id = array('id' => $_GET['preference_id']);
				if(session()->has('carrito')){
					$carrito = session()->get('carrito');
					$preference = Preference::read($id);												
					$pedido = new Pedido; 
					$pedido->user_id = Auth::user()->id;
					$pedido->status = 'pending';
					$subtotal = 0;				
					foreach(array_unique($carrito->products) as $product){
						$count = 0;
						foreach ($carrito->products as $product1){						
							$product_local = Product::find($product1->id);
							$product_local->stock = $product_local->stock - 1;
							$product_local->save();					
						if($product->name == $product1->name && $product->talle == $product1->talle && $product->color == $product1->color){
							$count++;
						}
					}				
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
				}    		  		                                                                                                                                                                                                                                                                                                                                                                                                                   
		  		$envio = 500;
				$total = $subtotal + $envio; 
				$pedido->amount = $total;
				$payer = $preference->payer;
				$adress = $payer->address;
				$phone = $payer->phone;
				$ident = $payer->identification;
				$pedido->zip_code = $adress->zip_code;
				$pedido->street_name =$adress->street_name;
				$pedido->street_number = $adress->street_number;				
				$pedido->phone = $phone->number;
				$pedido->dni = $ident->number;
				$pedido->preference_id = $request['preference_id'];
				$pedido->location = $preference->additional_info;												
				$pedido->save();			

				foreach($carrito->products as $product){
					$order = new Orden();
					$order->product_id = $product->id;
					$order->pedido_id = $pedido->id;
					$order->save(); 									
				}
				}
			}					
			return redirect('/dashboard');
	}

	public function dashboard(Request $request){						
		return view('dashboard');					
	}






}