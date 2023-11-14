<?php

namespace App\Http\Requests\Ausencia;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends FormRequest
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
            "fecha_de_llenado" => "required|date",
            "fecha_de_inicio" => "required|date",
            "fecha_de_termino" => "required|date",
            "dias_disfrute"=>"required|integer",

            "empleado_id"=>"required|integer",
            "status_id"=>"required|integer",
            "motivo_id"=>"required|integer",
            "feriado_id"=>"required|integer",
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
