<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title'    => 'required|string',
                    'markdown' => 'required|string',
                ];
            case 'PATCH':
                return [
                    'title'    => 'string',
                    'markdown' => 'string',
                ];
            default:
                return [

                ];
        }
    }
}
