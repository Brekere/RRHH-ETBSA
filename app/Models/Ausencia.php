<?php

namespace App\Models;

use App\Models\Motivo;
use App\Models\Status;
use App\Models\Feriado;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ausencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_de_llenado',
        'fecha_de_inicio',
        'fecha_de_termino',
        'dias_disfrute',

        'empleado_id',
        'status_id',
        'motivo_id',
        'feriado_id'
    ];

    public function Empleado(){
        return $this->belongsTo(Empleado::class);
    }

    public function Status(){
        return $this->belongsTo(Status::class);
    }

    public function Motivo(){
        return $this->belongsTo(Motivo::class);
    }

    public function Feriado(){
        return $this->belongsTo(Feriado::class);
    }
}
