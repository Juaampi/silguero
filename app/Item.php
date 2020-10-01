<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	public $id; 
	public $title; 
	public $description;
	public $picture_url;
	public $category_id;
	public $quantity;
	public $currency_id;
	public $unit_price;

}
