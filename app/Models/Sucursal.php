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

        'gerente'
    ];

    public function Gerente(){
        return $this->belongsTo(Empleado::class, 'gerente');
    }

    //---------------------------------------------------------------------------------

    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
