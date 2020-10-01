<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model {

	protected $table = 'subcategory';
	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'category_id'];

	public function category(){

        return $this->belongsTo('App\Category');
    }

}
