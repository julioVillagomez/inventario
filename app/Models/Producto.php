<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['sku','nombre','descripcion','cantidad','precio','estado','url','path'];


    public function categorias(){
        return $this->belongsToMany(Categoria::class,'categoria_producto','producto_id','categoria_id');
    }

    public function calificaciones(){
        return $this->hasMany(ProductoCalificacion::class);
    }
}
