<?php

namespace App\Models;

use App\Models\Ausencia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feriado extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'descripcion'
    ];

    public function Ausencia(){
        return $this->belongsToMany(Ausencia::class, 'ausencias_feriados', 'feriado_id', 'ausencia_id');
    }
}
