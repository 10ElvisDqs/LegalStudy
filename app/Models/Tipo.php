<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;
    //
    //$table->id();
    // $table->string('nombre',100);
    // $table->float('precio');
    // $table->unsignedBigInteger('id_categoria');
    // $table->timestamps();
    // $table->foreign('id_categoria')->references('id')->on('categorias');
    protected $fillable = ['nombre', 'precio', 'id_categoria'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
    
}
