<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    /**
     * Valid ingress index producto.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/productos');

        $response->assertStatus(200);
    }


    /**
     * Valid store producto.
     *
     * @return void
     */
    public function test_success_store(){

        $response = $this->post('productos',[
            'nombre' => 'Producto 1',
            'descripcion' => 'descripcion loca',
            'sku' => 's182j3sid',
            'categoria_id' => '1',
            'cantidad' => '10',
            'precio' => '120.2',
            'estado' => 'con inventario',
            '_token' => csrf_token()
        ]);

        $response->assertStatus(200);

    }

     /**
     * Failed validation store producto.
     *
     * @return void
     */
    public function test_failed_validation_store(){
        $response = $this->post('productos');

        $response->assertStatus(302);
    }


    /**
     * Valid update producto.
     *
     * @return void
     */
    public function test_success_update(){

        $producto = Producto::latest()->first();

        $response = $this->put('productos/'.$producto->id,[
            'nombre' => 'Producto 2',
            'descripcion' => 'descripcion loca',
            'sku' => 's182j3sid',
            'categoria_id' => '1',
            'cantidad' => '10',
            'precio' => '120.222',
            'estado' => 'sin inventario',
            '_token' => csrf_token()

        ]);

        $response->assertStatus(200);

    }

    /**
     * Failed validation update producto.
     *
     * @return void
     */
    public function test_failed_validation_update(){

        $producto = Producto::latest()->first();

        $response = $this->put('productos/'.$producto->id);

        $response->assertStatus(302);
    }


    /**
     * success  delete producto.
     *
     * @return void
     */
    public function test_success_delete(){

        $producto = Producto::latest()->first();

        $response = $this->delete('productos/'.$producto->id);

        $response->assertStatus(200);
    }

    
}
