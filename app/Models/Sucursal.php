<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'domicilio',
        'encargado'
    ];

    public function lineas()
    {
        return $this->belongsToMany(Linea::class, 'sucursales_lineas', 'sucursal_id', 'linea_id');
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'sucursales_departamentos', 'sucursal_id', 'departamento_id');
    }

    public function Encargado(){
        return $this->belongsTo(Empleado::class,'numero_de_empleado');
    }

    //---------------------------------------------------------------------------------

    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
