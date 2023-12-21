<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'documentos';
    protected $fillable = ['nombre', 'descripcion', 'fecha'];

    public function casos()
    {
        return $this->belongsTo(Caso::class, 'id_caso');
    }
}
