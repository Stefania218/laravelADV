<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';

    protected $primaryKey='idArticulo';

    public $timestamps=false; //para q no se agreguen automaticamente

    protected $fillable=[
        'idCategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado',
    ];

    protected $guarded =[

    ];//
}
