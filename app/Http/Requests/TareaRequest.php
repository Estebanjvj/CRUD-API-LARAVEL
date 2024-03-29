<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
//use Waavi\Sanitizer\Laravel\SanitizesInput; to filters

class TareaRequest extends FormRequest
{
    //use ApiResponse;

    /*public function validateResolved()
    {
        {
            $this->sanitize();
            parent::validateResolved();
        }
    }*/
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
        return [
            'title'=>'required|max:225'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Echale 2 pesos de titulo, no seas qlo.'
        ];
    }
}
