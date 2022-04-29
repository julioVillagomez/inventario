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

            return ProductoResource::collection(Producto::orderBy('id','desc')->get()->load('categorias','calificaciones'))->additional(['error' => false]);
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
                $filename = $uploadedFile->getClientOriginalName();
                $path = Storage::disk('public')->put('images',$uploadedFile);

                $data = $request->all();

                $data['path'] = $path;
                $data['url'] = Storage::disk('public')->url($path);
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

        if(request()->ajax()){
            $producto->load('categorias','calificaciones');
            return ProductoResource::make($producto)->additional(['error' => false]);
        }
        
        return view('productos.detail');
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


    /**
     * save calificacion
     *
     * @param Producto $producto
     * @param Request $request
     * @return void
     */
    public function calificacion(Producto $producto,Request $request){
        $request->validate([
            'calification' => 'required'
        ]);

        $producto->calificaciones()->create([
            'calificacion' => $request->calification
        ]);

        return response()->success('Calificacion gurdada correctamente');

    }
}
