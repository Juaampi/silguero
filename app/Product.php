<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table = 'products';
	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['luz', 'gas', 'agua','cloacas', 'dolar', 'adicional', 'direccion', 'description', 'preciototal', 'preciomensual', 'ambientes', 'metros', 'category_id', 'subcategory_id', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6', 'img7', 'img8', 'img9', 'img10', 'habitaciones', 'baños', 'barrio', 'cochera'];	

}
