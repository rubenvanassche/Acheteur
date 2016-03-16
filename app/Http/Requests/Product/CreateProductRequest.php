<?php

namespace App\Http\Requests\Product;

use App\Configuration;
use App\Http\Requests\Request;

class CreateProductRequest extends Request
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


        if(Configuration::event()->hasShifts() == true){
            foreach(Configuration::event()->shifts()->get() as $shift){
                $rules['available'.$shift->id] = 'required|numeric|integer';
            }
        }else{
            $rules['available'] = 'required|numeric|integer';
        }

        return $rules;
    }
}
