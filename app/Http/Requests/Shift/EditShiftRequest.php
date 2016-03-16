<?php

namespace App\Http\Requests\Shift;

use App\Http\Requests\Request;

class EditShiftRequest extends Request
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
        return [
            'start' => 'required|date_format:d-m-Y G:i:s',
            'end' => 'required|date_format:d-m-Y G:i:s',
        ];
    }
}
