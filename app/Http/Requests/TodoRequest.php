<?php

namespace App\Http\Requests;

class TodoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            case 'POST':
            case 'PATCH':
                return [
                    'title' => 'required|min:2',
                    'type' => 'in:markdown,body',
                    'content.body' => 'required_if:type,body',
                    'content.markdown' => 'required_if:type,markdown',
                ];
            default:
                return [
                    //
                ];
        }
    }
}
