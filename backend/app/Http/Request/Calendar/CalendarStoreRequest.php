<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Constants\HttpResponseStatus;

class CalendarStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'description' => 'required',
            'customer_name' => 'sometimes|required|max:255',
            'customer_email' => 'sometimes|required|max:255',
            'requester_id' => 'sometimes|required|integer',
            'requested_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'start_at.required' => 'O campo DATA DE INÍCIO é obrigatório',
            'start_at.date' => 'O campo DATA DE INÍCIO precisa ser uma data válida',
            'end_at.required' => 'O campo DATA DE CONCLUSÃO é obrigatório',
            'end_at.date' => 'O campo DATA DE CONCLUSÃO precisa ser uma data válida',
            'customer_name.required' => 'O campo CLIENTE NOME é obrigatório',
            'customer_name.max' => 'O campo CLIENTE NOME deve ter no máximo 255 caracteres',
            'customer_email.required' => 'O campo CLIENTE E-MAIL é obrigatório',
            'customer_email.max' => 'O campo CLIENTE E-MAIL deve ter no máximo 255 caracteres',
            'requester_id.required' => 'O campo REQUISITANTE é obrigatório',
            'requester_id.integer' => 'O campo REQUISITANTE precisar ser um valor númerico',
            'requested_id.required' => 'O campo REQUISITADO é obrigatório',
            'requested_id.integer' => 'O campo REQUISITADO precisar ser um valor númerico'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], HttpResponseStatus::BAD_REQUEST));
    }
}
