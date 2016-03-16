<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preferences';
    public $timestamps = true;

    public function event(){
        return $this->belongsTo('App\Event');
    }

}
