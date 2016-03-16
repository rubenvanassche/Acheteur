<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements SluggableInterface {

	protected $table = 'pages';
	public $timestamps = true;

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'title',
		'save_to'    => 'slug',
		'unique'     => 'true',
	];

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

	public function sections()
	{
		return $this->hasMany('App\Section');
	}

    public function makeSlugUnique($slug){
		if($this->needsSlugging() == false){

		}

		$pages = $this->where('event_id', Configuration::eventId())->get();

		if($pages->where('slug',$slug)->count() > 0){
			return $slug.'-'.$this->generateSuffix($slug, $pages->pluck('slug')->flatten()->toArray());
		}else{
			return $slug;
		}
	}

	public function getFrontViewPath(){
		return Configuration::event()->getViewsFolder().'/front/'.$this->slug.'.blade.php';
	}

	public function getFrontView(){
		return 'events.'.Configuration::event()->slug.'.front.'.$this->slug;
	}

	public static function getHomePageSlug(){
		$eventID = Configuration::eventId();
		return Page::where('event_id', $eventID)->where('home', '1')->first()->slug;
	}


}
