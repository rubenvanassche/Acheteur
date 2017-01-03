<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Collection;

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
		$products = Product::where('event_id', Configuration::eventId())->get();

		// Setup dates
		$statistics =  Order::with('orderlists')->where('event_id', $this->id)->orderBy('created_at')->get();
		$firstDate = $statistics->first()->created_at;
		$lastDate = $statistics->last()->created_at;

		// Get dates between firstdate and lastdate and put them in output
		$output = new Collection();
		for($date = $firstDate;$date->lte($lastDate);$date->addDay()){
			// Get the product ID's and put them in an array
			$data = new Collection();
			foreach($products as $product){
				$data->put($product->id, 0);
			}

			$output->put($date->format('d-m-Y'), $data);
		}

		// Add the amounts of products ordered from the orderlists
		foreach($statistics as $order){
			$date = $order->created_at->format('d-m-Y');
			foreach($order->orderlists()->get() as $orderlist){
				$output[$date][$orderlist->product_id] = $orderlist->amount;
			}
		}



		return $output;
	}

}
