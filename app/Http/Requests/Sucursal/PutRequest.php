<?php

namespace App\Http\Requests\Sucursal;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class PutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|min:3|max:255'. $this->route("sucursal")->id,
            'domicilio' => 'required|string|max:255,'. $this->route("sucursal")->id,
            'encargado' => 'nullable|integer',
        ];
    }

    function failedValidation(Validator $validator)
    {
        if($this->expectsJson())
            {
                $response = new Response($validator->errors(),422);
                throw new ValidationException($validator, $response);
            }
    }
}