<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model {

	protected $table = 'shifts';
	public $timestamps = true;

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function getStartAttribute($value){
        return Carbon::createFromFormat('Y-m-d G:i:s', $value)->format('d-m-Y G:i:s');
    }

    public function getEndAttribute($value){
        return Carbon::createFromFormat('Y-m-d G:i:s', $value)->format('d-m-Y G:i:s');
    }

	public function setStartAttribute($value){
        $this->attributes['start'] = Carbon::createFromFormat('d-m-Y G:i:s', $value)->format('Y-m-d G:i:s');
	}

    public function setEndAttribute($value){
        $this->attributes['end'] = Carbon::createFromFormat('d-m-Y G:i:s', $value)->format('Y-m-d G:i:s');
    }

	public function beautify(){
		$start = Carbon::createFromFormat('d-m-Y G:i:s', $this->start);
		$end = Carbon::createFromFormat('d-m-Y G:i:s', $this->end);


		if($start->year == $end->year){
			if($start->month == $end->month){
				if($start->day == $end->day){
					if($start->hour == $end->hour){
						if($start->minute == $end->minute){
							// Seconds
							return $start->format('G:i:s'). " - " .$end->format('G:i:s');
						}else{
							// Minutes
							return $start->format('G:i'). " - " .$end->format('G:i');
						}
					}else{
						// Hours
						return $start->format('G:i'). " - " .$end->format('G:i');
					}
				}else{
					//Days
					return $start->format('G:i  d/m'). " - " .$end->format('G:i  d/m');
				}
			}else{
				// Months
				return $start->format('G:i  d/m'). " - " .$end->format('G:i  d/m');
			}
		}else{
			// Years
			return $start->format('G:i  d/m/Y'). " - " .$end->format('G:i  d/m/Y');
		}
	}
}