<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4/10/15
 * Time: 16:57
 */

namespace App\SectionTypes;


use App\Configuration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MediumEditor extends SectionType{
    // Render based upon content from the database
    public function render($content){
        return $content;
    }

    public function save(Request $request, Model $model){
        $model->content = $request->input('content');
    }

    public function delete($content){

    }

    // Css to inject
    public function css(){
        $out = '<link rel="stylesheet" type="text/css" href="'.asset('assets/mediumeditor/css/medium-editor.min.css').'">';
        $out .= '<link rel="stylesheet" type="text/css" href="'.asset('assets/mediumeditor/css/themes/beagle.min.css').'">';

        return $out;
    }

    // Javascript To Inject
    public function javascript(){
        $out  =  '<script type="text/javascript" src="'.asset('assets/mediumeditor/js/medium-editor.min.js').'"></script>';
        $out .=  '<script type="text/javascript">
                    var editor = new MediumEditor(".mediumeditor");
                  </script>';

        return $out;
    }

    // HTML Form
    public function form($content = ''){
        return "<div class='field'><textarea name='content' class='mediumeditor'>".$content."</textarea></div>";
    }

    // Validation rules
    public function validationRules(){
        return ['content'=>'required'];
    }
}