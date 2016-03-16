<?php

/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 4/10/15
 * Time: 16:52
 */

namespace App\SectionTypes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class SectionType{
    var $name;

    var $handle;

    // Render based upon content from the database
    abstract public function render($content);

    abstract public function save(Request $request, Model $model);

    abstract public function delete($content);

    // Css to inject
    abstract public function css();

    // Javascript To Inject
    abstract public function javascript();

    // HTML Form
    abstract public function form($content = '');

    // Validation rules
    abstract public function validationRules();
}