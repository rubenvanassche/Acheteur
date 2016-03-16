<?php

namespace App\Http\Requests\Product;

use App\Configuration;
use App\Http\Requests\Request;

class EditProductRequest extends Request
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
        $rules = array(
            'name' => 'required',
            'description' => '',
            'price' => 'required|numeric',
        );

        if(Configuration::event()->hasShifts() == false){
            $rules['available'] = 'required|numeric|integer';
        }

        return $rules;
    }
}
