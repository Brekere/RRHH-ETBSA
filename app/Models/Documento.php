<?php

namespace App\Models;

use App\Models\Requisito;
use App\Models\Expediente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'path',

        'requisito_id'
    ];

    public function Requisito(){
        return $this->belongsTo(Requisito::class);
    }

    public function Expediente(){
        return $this->hasMany(Expediente::class);
    }
}
