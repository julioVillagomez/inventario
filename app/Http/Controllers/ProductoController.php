<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return ProductoResource::collection(Producto::all())->additional(['error' => false]);
        }


        return view('productos.index');
    }


    /**
     * show view form.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('productos.create');
    }

    

    /**
     * Save new productos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        Producto::create($request->all());
        return response()->success('Se guardo correctamente el producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return ProductoResource::make($producto)->additional(['error' => false]);
    }



    /**
     * Update producto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->all());

        return response()->success('Se actualizo correctamente el producto');

    }

    /**
     * delete producto.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->success('Se elimino correctamente el producto');

    }
}
