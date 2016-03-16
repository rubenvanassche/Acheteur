<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 6/10/15
 * Time: 02:04
 */

namespace App\SectionTypes;


use App\Configuration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Image extends SectionType{
    // Render based upon content from the database
    public function render($content){
        return $content;
    }

    public function save(Request $request, Model $model){
        if ($request->hasfile('image')) {

            // config
            $directory_upload = 'uploads/'.Configuration::event()->slug;
            // file
            $file = $request->file('image');
            // Problem on some configurations
            $file = (!method_exists($file, 'getClientOriginalName')) ? $file['file'] : $file;
            // filename
            $filename = $file->getClientOriginalName();
            // suffixe if file exists
            $suffixe = '01';
            // verif if file exists
            while (file_exists(public_path($directory_upload).'/'.$filename)) {
                $filename = $suffixe.'_'.$filename;
                $suffixe++;
                if ($suffixe < 10) {
                    $suffixe = '0'.$suffixe;
                }
            }
            if ($file->move(public_path($directory_upload), $filename)) {
                $model->content = '/'.$directory_upload.'/'.$filename;
            }
        }
    }

    public function delete($content){

    }

    // Css to inject
    public function css(){

    }

    // Javascript To Inject
    public function javascript(){

    }

    // HTML Form
    public function form($content = ''){
        if($content == ''){
            return '<div class="field">
                    <label>Image</label>
                    <input type="file" name="image">
                 </div>';
        }else{
            return '
                    <div class="field">
                    <img class="ui fluid image" src="'.$content.'">
                    <label>Image(leave empty if you do not want to change)</label>
                    <input type="file" name="image">
                 </div>';
        }

    }

    // Validation rules
    public function validationRules(){
        return ['image' => 'image'];
    }
}