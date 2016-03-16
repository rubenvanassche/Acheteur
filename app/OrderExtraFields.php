<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderExtraFields extends Model {

	protected $table = 'order_extra_fields';
	public $timestamps = true;

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

	public function orderExtraFields()
	{
		return $this->belongsTo('App\Order', 'id');
	}

}