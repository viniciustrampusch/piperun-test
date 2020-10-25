<?php

namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Constants\HttpResponseStatus;

class CalendarModerateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'status_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'status_id.required' => 'O campo STATUS é obrigatório',
            'status_id.integer' => 'O campo STATUS precisar ser um valor númerico',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], HttpResponseStatus::BAD_REQUEST));
    }
}
