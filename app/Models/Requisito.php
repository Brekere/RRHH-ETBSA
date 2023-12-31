<?php

namespace App\Models;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requisito extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function Documento(){
        return $this->hasOne(Documento::class);
    }
}
