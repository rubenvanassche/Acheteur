<?php

namespace App\Http\Requests\Shift;

use App\Configuration;
use App\Http\Requests\Request;
use App\Product;

class CreateShiftRequest extends Request
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
    public function rules()
    {
        $rules =  array(
            'start' => 'required|date_format:d-m-Y G:i:s',
            'end' => 'required|date_format:d-m-Y G:i:s',
        );

        foreach(Product::where('event_id', Configuration::eventId())->get() as $product){
            $rules['available'.$product->id] = 'required|integer';
        }

        return $rules;
    }
}
