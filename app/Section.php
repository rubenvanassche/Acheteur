<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Section extends Model implements SluggableInterface {

	protected $table = 'sections';
	public $timestamps = true;

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'name',
		'save_to'    => 'slug',
		'unique'     => 'true',
	];

	public function page()
	{
		return $this->belongsTo('App\Page');
	}

	public function makeSlugUnique($slug){
		if($this->needsSlugging() == false){

		}

		$sections = $this->where('page_id', $this->page_id)->get();


		if($sections->where('slug',$slug)->count() > 0){
			return $slug.'-'.$this->generateSuffix($slug, $sections->pluck('slug')->flatten()->toArray());
		}else{
			return $slug;
		}
	}

}
