<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAvailability extends Model {

	protected $table = 'product_availability';
	public $timestamps = true;
	protected $fillable = ['shift_id', 'available'];

	public function product(){
		return $this->belongsTo('App\Product');
	}

	public function shift(){
		return $this->belongsTo('App\Shift');
	}

}