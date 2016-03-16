<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Event extends Model implements SluggableInterface {
	protected $table = 'events';
	public $timestamps = true;

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'name',
		'save_to'    => 'slug',
		'unique'     => 'true',
	];

	public function products()
	{
		return $this->hasMany('App\Product');
	}

	public function orders()
	{
		return $this->hasMany('App\Order');
	}

	public function shifts()
	{
		return $this->hasMany('App\Shift');
	}

	public function pages()
	{
		return $this->hasMany('App\Page');
	}

	public function preferences()
	{
		return $this->hasMany('App\Preference');
	}

	public function orderExtraFields()
	{
		return $this->hasMany('App\OrderExtraFields');
	}

	public function getAssetsFolder()
	{
		return 'public/events/'. $this->getSlug();
	}

	public function getViewsFolder()
	{
		return 'resources/views/events/'. $this->getSlug();
	}

	public function getUploadsFolder()
	{
		return 'public/uploads/'. $this->getSlug();
	}

	public function hasShifts(){
		if($this->shifts == 0){
			return false;
		}else{
			return true;
		}
	}

	// Returns an collection with as key the date and as value a list of keys(product_id) and values sold on that date
	public function statistics(){
		return Order::with('orderlists')->where('event_id', $this->id)->orderBy('created_at')->get();
	}

}
