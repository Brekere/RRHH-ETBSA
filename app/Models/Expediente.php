<?php

namespace App\Models;

use App\Models\Empleado;
use App\Models\Documento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',

        'documento_id'
    ];
    
    public function Documento(){
        return $this->belongsTo(Documento::class,);
    }

    //--------------------------------------------------------------------------

    public function Empleado(){
        return $this->hasOne(Empleado::class);
    }
}
