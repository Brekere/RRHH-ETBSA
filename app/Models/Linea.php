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

        'gerente'
    ];

    public function Gerente(){
        return $this->belongsTo(Empleado::class, 'gerente');
    }

    //---------------------------------------------------------------------

    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
