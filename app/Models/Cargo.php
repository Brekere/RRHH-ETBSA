<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
