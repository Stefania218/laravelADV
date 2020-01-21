<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table='ingreso';

    protected $primaryKey='idIngreso';

    public $timestamps=false; //para q no se agreguen automaticamente

    protected $fillable=[
        'idProveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'estado'
    ];

    protected $guarded =[

    ];//
}
