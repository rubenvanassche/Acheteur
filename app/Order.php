<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	protected $table = 'orders';
	public $timestamps = true;

	public function orderlists()
	{
		return $this->hasMany('App\Orderlist');
	}

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

	public function shift()
	{
		return $this->belongsTo('App\Shift');
	}

	public function extraFields()
	{
		return $this->hasOne('App\OrderExtraFields');
	}

	public function payments()
	{
		return $this->hasMany('App\Payment');
	}

	public function cost(){
		$total = 0;
		foreach($this->orderlists()->get() as $orderlist){
			$total += $orderlist->amount*$orderlist->product->price;
		}

		return $total;
	}

	public function afterPage(){
		if($this->after_order_page_id == 0){
			return Page::where('event_id', Configuration::eventId())->where('home', '1')->first();
		}else{
			return Page::where('id', $this->after_order_page_id)->first();
		}

	}

}