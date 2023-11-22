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
        'fecha_de_inicio',
        'fecha_de_termino',
        'fecha_de_regreso',
        'dias_disfrute',

        'solicitante',
        'quien_cubre',
        'status_id',
        'motivo_id',
        'feriado_id'
    ];

    public function Solicitante(){
        return $this->belongsTo(Empleado::class,'empleados');
    }

    public function QuienCubre(){
        return $this->belongsTo(Empleado::class,'empleados');
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
