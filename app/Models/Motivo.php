<?php

namespace App\Models;

use App\Models\Ausencia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function Ausencia(){
        return $this->hasOne(Ausencia::class);
    }
}
