<?php

namespace App\Http\Requests\Empleado;

use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

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
            "nombre" => ['required', 'string', 'max:500'],
            "apellido_paterno" => ['required', 'string', 'max:500'],
            "apellido_materno" => ['required', 'string', 'max:500'],
            "curp" => ['required', 'string', 'min:18', 'max:18', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "rfc" => ['required', 'string', 'min:13', 'max:13', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "imss" => ['required', 'numeric', 'digits:11', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "domicilio" => ['required', 'string', 'max:500', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "telefono" => ['required', 'numeric', 'digits:10', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "fecha_de_ingreso" => ['required', 'date'],
            "cuenta_de_nomina" => ['required', 'numeric', 'digits:20', Rule::unique('empleados')->ignore($this->route("empleado")->id)],

            "user_id" => ['required', 'integer', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "sucursal_id" => ['required', 'integer'],
            "linea_id" => ['required', 'integer'],
            "departamento_id" => ['required', 'integer'],
            "cargo_id" => ['required', 'integer'],
            "expediente_id" => ['required', 'integer', Rule::unique('empleados')->ignore($this->route("empleado")->id)],
            "periodo_id" => ['required', 'integer'],
        ];
    }

    function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        }
    }
}
