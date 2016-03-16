<?php

namespace App\Http\Requests\Product;

use App\Configuration;
use App\Http\Requests\Request;

class EditProductAvailabilityRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        foreach(Configuration::event()->shifts()->get() as $shift){
            $rules['available'.$shift->id] = 'required|numeric|integer';
        }


        return $rules;
    }
}
