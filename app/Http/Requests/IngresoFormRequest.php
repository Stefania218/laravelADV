<?php

namespace sisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //para no tener problemas se cambia de false a true:P
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idProveedor'=>'required',
            'tipo_comprobante'=>'required|max:20',
            'serie_comprobante'=>'max:7',
            'num_comprobante'=>'required|max:10',
            'idArticulo'=>'required',
            'cantidad'=>'required',
            'precio_compra'=>'required',
            'precio_venta'=>'required'
        ];
    }
}
