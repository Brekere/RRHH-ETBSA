<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function lineas()
    {
        return $this->belongsToMany(Linea::class, 'departamentos_lineas', 'departamento_id', 'linea_id');
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'sucursales_departamentos', 'departamento_id', 'sucursal_id');
    }

    //-----------------------------------------------------------------------

    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
