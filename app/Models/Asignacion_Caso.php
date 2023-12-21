<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion_Caso extends Model
{
    use HasFactory;
    protected $table = 'asignacion_casos'; // Especifica el nombre de la tabla intermedia

    public function caso()
    {
        return $this->belongsTo(Caso::class, 'id_caso');
    }

    public function abogado()
    {
        return $this->belongsTo(User::class, 'id_abogado');
    }
}
