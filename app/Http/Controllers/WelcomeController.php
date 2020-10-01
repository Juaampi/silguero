<?php namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use App\Product;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
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

}
