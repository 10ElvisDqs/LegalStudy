<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','descripcion', 'fecha_apertura', 'estado', 'id_tipo', 'id_cliente'];

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'id_cliente');
    }
    // En tu modelo Caso.php
    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }

}
