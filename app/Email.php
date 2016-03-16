<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 6/10/15
 * Time: 03:13
 */

namespace App;


use Illuminate\Database\Eloquent\Collection;

class Email{
    static $emails = [
        ['type' => 'orderconfirmation', 'view' => 'orderconfirmation', 'description' => 'Email send to customer when order complete']
    ];

    static function emailViewPath(){
        return Configuration::event()->getViewsFolder().'/email';
    }

    static function all(){
        $collection = collect(self::$emails);
        return $collection->keyBy('type');
    }

    static function viewPath($type){
        $collection = collect(self::$emails);
        $sectionType = $collection->where('type', $type)->first();

        return self::emailViewPath().'/'.$sectionType['view'].'.blade.php';
    }

    static function view($type){
        $collection = collect(self::$emails);
        $sectionType = $collection->where('type', $type)->first();

        return 'events.' . Configuration::event()->slug . '.email.' . $sectionType['view'];
    }
}