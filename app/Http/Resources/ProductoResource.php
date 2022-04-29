<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $estado = $this->estado == "con inventario" ? 'Con stock' : 'Sin stock'; 

        $categorias = collect($this->categorias)->implode('nombre',', ');
        $calificacion = collect($this->calificaciones)->avg('calificacion');;

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'sku' => $this->sku,
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'path' => $this->path,
            'url' => $this->url,
            'estado' => $estado,
            'categorias' => $categorias,
            'calificacion' => round($calificacion)
        ];
    }
}

