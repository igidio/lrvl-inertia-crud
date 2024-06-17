<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'cita';

    protected $fillable = [
        'id_cliente',
        'id_servicio',
        'fecha',
        'hora',
        'notas',
    ];

    public function cliente()
    {
        return $this->belongsTo(Customer::class, 'id_cliente');
    }
    public function servicio()
    {
        return $this->belongsTo(Service::class, 'id_servicio');
    }

    use HasFactory;
}
