<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function Ausencia(){
        return $this->hasOne(Ausencia::class);
    }
}
