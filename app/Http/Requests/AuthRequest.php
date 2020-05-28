<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        switch ($this->getRequestUri()) {
            case '/auth/register':
                return [
                    'email'     => 'required|email|unique:users,email',
                    'password'  => 'required|min:6'
                ];
            case '/auth/login':
                return [
                    'username'  => 'required',
                    'password'  => 'required|min:6'
                ];
            default:
                return [];
        }

    }
}
