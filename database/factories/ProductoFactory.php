<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'descripcion' => $this->faker->text(),
            'sku' => $this->faker->text(10),
            'cantidad' => $this->faker->randomDigit(),
            'precio' => $this->faker->randomFloat(2,1000,10000),
            'categoria_id' => 1,

        ];
    }


    public function categorias(){
        return $this->afterCreating(function(Producto $producto){
            $categorias = Categoria::inRandomOrder()->take(3)->get()->pluck('id')->toArray();

            $producto->categorias()->sync($categorias);
        });
    }
}
