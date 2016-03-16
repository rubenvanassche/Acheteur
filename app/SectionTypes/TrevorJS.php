<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4/10/15
 * Time: 16:57
 */

namespace App\SectionTypes;


use App\Configuration;
use Caouecs\Sirtrevorjs\SirTrevorJs;
use Caouecs\Sirtrevorjs\SirTrevorJsConverter as STConverter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TrevorJS extends SectionType{
    // Render based upon content from the database
    public function render($content){
        $convert = new STConverter();
        return $convert->toHtml($content);
    }

    public function save(Request $request, Model $model){
        $model->content = $request->input('content');
    }

    public function delete($content){

    }

    // Css to inject
    public function css(){
        $out = '<link rel="stylesheet" type="text/css" href="'.asset('assets/sir-trevor-js/sir-trevor.css').'">';

        return $out;
    }

    // Javascript To Inject
    public function javascript(){
        $out  =  '<script type="text/javascript" src="'.asset('assets/sir-trevor-js/sir-trevor.js').'"></script>';
        $out .=  '<script type="text/javascript">
                    new SirTrevor.Editor({
                        el: $(".sir-trevor"),
                        blockTypes: ["Text", "List", "Quote", "Image", "Video",  "Heading"]
                    });
                    SirTrevor.setDefaults({
                      uploadUrl: "'.action('SirTrevorJsController@upload').'"

                    });
                    SirTrevor.setBlockOptions("Tweet", {
                      fetchUrl: function(tweetID) {
                        return "'.action('SirTrevorJsController@tweet').'?tweet_id=" + tweetID;
                      }
                    });
                  </script>';

        return $out;
    }

    // HTML Form
    public function form($content = ''){
        return "<div class='field'><label>Content</label><textarea name='content' class='sir-trevor'>".$content."</textarea></div>";
    }

    // Validation rules
    public function validationRules(){
        return ['content'=>'required'];
    }
}