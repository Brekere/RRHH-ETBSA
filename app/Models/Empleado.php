<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cargo;
use App\Models\Linea;
use App\Models\Periodo;
use App\Models\Ausencia;
use App\Models\Sucursal;
use App\Models\Expediente;
use App\Models\Departamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'curp',
        'rfc',
        'imss',
        'domicilio',
        'telefono',
        'fecha_de_ingreso',
        'cuenta_de_nomina',

        'user_id',
        'sucursal_id',
        'linea_id',
        'departamento_id',
        'cargo_id',
        'expediente_id',
        'periodo_id',
        'jefe_directo'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function Linea(){
        return $this->belongsTo(Linea::class);
    }

    public function Departamento(){
        return $this->belongsTo(Departamento::class);
    }

    public function Cargo(){
        return $this->belongsTo(Cargo::class);
    }

    public function Expediente(){
        return $this->belongsTo(Expediente::class);
    }

    public function Periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function jefeDirecto()
    {
        return $this->belongsTo(Empleado::class, 'jefe_directo', 'numero_de_empleado');
    }

// --------------------------------------------------------------------------------


    public function Ausencia(){
        return $this->hasMany(Ausencia::class);
    }

    public function Empleado()
    {
        return $this->hasOne(Empleado::class, 'jefe_directo', 'numero_de_empleado');
    }

    public function Encargado_Sucursal(){
        return $this->hasOne(Sucursal::class);
    }

    public function Encargado_Linea(){
        return $this->hasOne(Linea::class);
    }

    public function Encargado_Departamento(){
        return $this->hasOne(Departamento::class);
    }
    
}
