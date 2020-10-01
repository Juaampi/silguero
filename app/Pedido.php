<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

	protected $table = 'pedidos';
	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'user_id', 'status', 'amount', 'zip_code', 'street_name', 'street_number', 'phone', 'created_at', 'updated_at', 'dni', 'city', 'location', 'adicional'];

	public function ordenes()
    {
        return $this->hasMany('App\Orden', 'pedido_id', 'id');
    }
}
