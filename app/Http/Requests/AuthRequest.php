<?php

namespace App\Http\Requests;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        switch ($this->path()) {
            case 'login':
                return [
                    'username' => 'required|string',
                    'password' => 'required|min:6',
                ];
            case 'register':
                return [
                    'name' => 'required|between:3,25|unique:users,name',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6',
                ];
            default:
                return [
                    //
                ];
        }
    }
}
