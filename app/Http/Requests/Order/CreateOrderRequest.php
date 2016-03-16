<?php

namespace App\Http\Requests\Order;

use App\Configuration;
use App\Http\Requests\Request;
use App\Product;
use App\Shift;

class CreateOrderRequest extends Request
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

        $out =  array(
            'name' => 'required',
            'email' => 'required|email',
        );

        // Products
        $products = Product::where('event_id', Configuration::eventId())->get();
        foreach($products as $product){
            $out['product'.$product->id] = 'integer|min:0';
        }

        // Shifts
        $hasShifts = Configuration::event()->hasShifts();
        if($hasShifts == true){
            $shifts = Shift::where('event_id', Configuration::eventId())->get();

            $in = '';
            foreach($shifts as $shift){
                $in .= $shift->id.',';
            }
            $in = rtrim($in, ",");

            $out['shift'] = 'required|integer|in:'.$in;
        }

        return $out;
    }
}
