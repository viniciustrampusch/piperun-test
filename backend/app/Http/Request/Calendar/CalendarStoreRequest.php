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
            'start_at_time' => 'required',
            'end_at' => 'required|date',
            'end_at_time' => 'required',
            'description' => 'required',
            'requested_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'start_at.required' => 'O campo DATA DE INÍCIO é obrigatório',
            'start_at.date' => 'O campo DATA DE INÍCIO precisa ser uma data válida',
            'start_at_time.required' => 'O campo HORA DE INÍCIO é obrigatório',
            'end_at.required' => 'O campo DATA DE CONCLUSÃO é obrigatório',
            'end_at.date' => 'O campo DATA DE CONCLUSÃO precisa ser uma data válida',
            'end_at_time.required' => 'O campo HORA DE CONCLUSÃO é obrigatório',
            'description.required' => 'O campo DESCRIÇÃO é obrigatório',
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
