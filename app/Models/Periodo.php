<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'años',
        'dias_correspondientes',
        'regimen'
    ];
    
    public function Empleado(){
        return $this->hasMany(Empleado::class);
    }
}
