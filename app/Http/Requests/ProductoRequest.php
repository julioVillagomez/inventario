<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:4',
            'descripcion' => 'required|min:4',
            'sku' => 'required|min:4',
            'cantidad' => 'required|integer',
            'precio' => 'required',
            'estado' => Rule::in(['con inventario','sin inventario']),
        ];
    }
}

