<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';

    protected $primaryKey='idPersona';

    public $timestamps=false; //para q no se agreguen automaticamente

    protected $fillable=[
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];

    protected $guarded =[

    ];//
}
