<?php

namespace App\Http\Requests\Empleado;

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
            "nombre"=>"required|string|max:500",
            "apellido_paterno"=>"required|string|max:500",
            "apellido_materno"=>"required|string|max:500",
            "curp"=>"required|string|min:18|max:18|unique:empleados,curp",
            "rfc"=>"required|string|min:13|max:13|unique:empleados,rfc",
            "imss"=>"required|string|min:11|max:11|unique:empleados,imss",
            "domicilio"=>"required|string|max:500|unique:empleados,domicilio",
            "telefono"=>"required|string|min:10|max:10|unique:empleados,telefono",
            "fecha_de_ingreso" => "required|date",
            "cuenta_de_nomina"=>"required|string|min:20|max:20|unique:empleados,cuenta_de_nomina",

            "user_id"=>"required|integer|unique:empleados,user_id",
            "sucursal_id"=>"required|integer",
            "linea_id"=>"required|integer",
            "departamento_id"=>"required|integer",
            "cargo_id"=>"required|integer",
            "expediente_id"=>"required|integer|unique:empleados,expediente_id",
            "periodo_id"=>"required|integer",
            'jefe_directo' => 'nullable|integer',
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
