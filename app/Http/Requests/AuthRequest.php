<?php

namespace App\Http\Requests;

class AuthRequest extends Request
{
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
