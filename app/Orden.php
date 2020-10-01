<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model {

	protected $table = 'orders';
	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['product_id', 'pedido_id'];

}
