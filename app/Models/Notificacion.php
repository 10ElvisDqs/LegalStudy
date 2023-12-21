<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacions';
    use HasFactory;

    public function casos()
    {
        return $this->belongsTo(Caso::class, 'id_caso');
    }
}
