<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['sku','nombre','descripcion','cantidad','precio','estado','url','path'];


    public function categorias(){
        return $this->belongsToMany(Categoria::class,'categoria_producto','producto_id','categoria_id');
    }
}
