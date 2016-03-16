<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;

class SectionTypes{
    public static  $types = array(
        array(
            'type' => 'trevor',
            'class'  => 'TrevorJS',
            'description' => 'An text area',
            'name' => 'Sir Trevor JS'
        ),
        array(
            'type' => 'image',
            'class'  => 'Image',
            'description' => 'An image',
            'name' => 'Image'
        ),
        array(
            'type' => 'mediumeditor',
            'class'  => 'MediumEditor',
            'description' => 'An WYSIWYG area',
            'name' => 'Medium Editor'
        )
    );

    static function createInstance($type){
        $collection = collect(self::$types);
        $sectionType = $collection->where('type', $type)->first();


        return App::make('App\SectionTypes\\'.$sectionType['class']);
    }

    static function getName($type){
        $collection = collect(self::$types);
        $sectionType = $collection->where('type', $type)->first();

        return $sectionType['name'];
    }

    static function getDescription($type){
        $collection = collect(self::$types);
        $sectionType = $collection->where('type', $type)->first();

        return $sectionType['description'];
    }

    static function getAll(){
        $collection = collect(self::$types);
        return $collection->keyBy('type');
    }

    static function validType($type){
        $collection = collect(self::$types);
        $sectionTypes = $collection->where('type', $type);
        if($sectionTypes->count() == 1){
            return true;
        }else{
            return false;
        }
    }
}