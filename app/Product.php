<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements SluggableInterface  {

	protected $table = 'products';
	public $timestamps = true;
	protected $fillable = ['name', 'description', 'price'];

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'name',
		'save_to'    => 'slug',
		'unique'     => 'true',
	];

	public function availability()
	{
		return $this->hasMany('App\ProductAvailability');
	}

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

	public function getAvailability(){
		if($this->event->hasShifts()){
			return $this->availability();
		}else{
			return $this->availability()->first()->available;
		}
	}

	// Items available defined
	public function available($shiftId = null){
		$hasShifts = Configuration::event()->hasShifts();

		if($hasShifts == false){
			return $this->availability()->first()->available;

		}else{
			return $this->availability()->where('shift_id', $shiftId)->first()->available;
		}
	}

	// Items sold
	public function sold($shiftId = null){
		$hasShifts = Configuration::event()->hasShifts();

		if($hasShifts == false){
			return $this->availability()->first()->sold;

		}else{
			return $this->availability()->where('shift_id', $shiftId)->first()->sold;
		}
	}

	// remove items from sold
	public function refund($amount, $shiftId = null){
		$hasShifts = Configuration::event()->hasShifts();

		if($hasShifts == false){
			$availability = ProductAvailability::where('product_id', $this->id)->first();
			$availability->sold = $availability->sold - $amount;
			$availability->save();
		}else{
			$availability = ProductAvailability::where('product_id', $this->id)->where('shift_id', $shiftId)->first();
			$availability->sold = $availability->sold - $amount;
			$availability->save();
		}
	}

	// add items to sold
	public function sell($amount, $shiftId = null){
		$hasShifts = Configuration::event()->hasShifts();

		if($hasShifts == false){
			$availability = ProductAvailability::where('product_id', $this->id)->first();
			$availability->sold = $availability->sold + $amount;
			$availability->save();
		}else{
			$availability = ProductAvailability::where('product_id', $this->id)->where('shift_id', $shiftId)->first();
			$availability->sold = $availability->sold + $amount;
			$availability->save();
		}
	}

	// Items still in stock available - sold
	public function stock($shiftId = null){
		$hasShifts = Configuration::event()->hasShifts();

		if($hasShifts == false){
			$availability = $this->availability()->first();
			return $availability->available - $availability->sold;
		}else{
			$availability = $this->availability()->where('shift_id', $shiftId)->first();
			return $availability->available - $availability->sold;
		}
	}

	// Is the product sold out?
	public function soldOut($shiftId = null){

		if($this->stock($shiftId) > 0){
			return false;
		}else{
			return true;
		}
	}

}