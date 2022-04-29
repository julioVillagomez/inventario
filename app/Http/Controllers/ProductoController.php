<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Categoria;
use App\Models\Producto;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage;
use DB;
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

            return ProductoResource::collection(Producto::all()->load('categorias'))->additional(['error' => false]);
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

        try {
            DB::beginTransaction();
                $uploadedFile = $request->file('image');
                $filename = \Str::uuid().$uploadedFile->getClientOriginalName();
                $path = Storage::disk('local')->put($filename,$uploadedFile);

                $data = $request->all();

                $data['path'] = $path;
                $data['url'] = Storage::disk('local')->url($path);
                $categorias = explode(',',$request->categorias);
                
                $producto = Producto::create($data);
                $producto->categorias()->sync($categorias);
                DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->error($th->getMessage());
        }
        
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
        $producto->load('categorias');
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

    
    /**
     * lists all categorias
     *
     * @return void
     */
    public function categorias(){
        return Categoria::all();
    }
}
