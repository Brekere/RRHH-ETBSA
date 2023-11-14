<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'encargado'
    ];

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'departamentos_lineas', 'linea_id', 'departamento_id');
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'sucursales_lineas', 'linea_id', 'sucursal_id');
    }

    public function Encargado(){
        return $this->belongsTo(Empleado::class);
    }

    //---------------------------------------------------------------------

    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
