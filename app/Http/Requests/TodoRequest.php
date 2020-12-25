<?php

namespace App\Http\Requests;

class TodoRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch (request()->method()) {
            case 'POST':
            case 'PATCH':
                return [
                    'matter' => 'required',
                ];
            default:
                return [];
        }
    }
}
