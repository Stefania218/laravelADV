<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false; //para q no se agreguen automaticamente

    protected $fillable=[
        'nombre',
        'descripcion',
        'condicion'
    ];

    protected $guarded =[

    ];//guarded indica q asigna al modelo los campos de arriba
}
