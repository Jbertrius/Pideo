<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FileCreateRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pic' => 'required',
            'conversation'  => 'required',
            'user_id' => 'required'
        ];
    }
}
