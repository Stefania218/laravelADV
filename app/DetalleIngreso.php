<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalle_ingreso';

    protected $primaryKey='idDetalle_ingreso';

    public $timestamps=false; //para q no se agreguen automaticamente

    protected $fillable=[
        'idIngreso',
        'idArticulo',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];

    protected $guarded =[

    ];//
}
