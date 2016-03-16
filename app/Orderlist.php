<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderlist extends Model {

	protected $table = 'orderlists';
	public $timestamps = true;

    public $fillable = ['product_id', 'amount'];

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function order()
	{
		return $this->hasOne('App\Order');
	}


}