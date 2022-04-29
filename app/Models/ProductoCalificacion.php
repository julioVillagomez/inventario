<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCalificacion extends Model
{
    use HasFactory;

    protected $table ="producto_calificaciones";

    protected $fillable = ['calificacion'];
}
