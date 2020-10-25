<?php

namespace App\Http\Request\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Constants\HttpResponseStatus;

class AuthLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo E-MAIL é obrigatório',
            'email.string' => 'O campo E-MAIL precisar ser no formato texto',
            'email.email' => 'O campo E-MAIL precisar ser um e-mail válido',
            'password.required' => 'O campo SENHA é obrigatório',
            'password.string' => 'O campo SENHA ser no formato texto'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], HttpResponseStatus::BAD_REQUEST));
    }
}
