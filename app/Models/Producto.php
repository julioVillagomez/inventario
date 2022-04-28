<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['sku','nombre','categoria_id','descripcion','cantidad','precio','estado'];


    public function categorias(){
        return $this->belongsToMany(Categoria::class,'categoria_producto','producto_id','categoria_id');
    }
}
