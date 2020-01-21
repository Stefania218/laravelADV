<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Persona;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\PersonaFormRequest;
use DB; 

class ClienteController extends Controller
{
   public function __construct()
    {

    }//constructor
    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText')); //almaceno todo en query y el trim dice q no dejo espacios en blanco
    		$personas=DB::table('persona')->where('nombre','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Cliente')  
            ->orwhere('num_documento','LIKE','%'.$query.'%')
            ->where ('tipo_persona','=','Cliente')
            ->orderBy('idpersona','desc')
            ->paginate(7);
    		return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]); //enviamos todas las categorias en un parametro llamado categoria y el texto de busqueda en un parametro llamada searchText.
            ////el nombre de la tabla categoria inicia y finaliza con la cadena query
    	}

    }
    public function create()
    {
        return view("ventas.cliente.create");//retorna la vista//retorna la vista

    }
    public function store(PersonaFormRequest $request)
    {
    	$persona=new Persona;//objeto modelo q hace referencia al modelo categoria
        $persona->tipo_persona='Cliente';
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
        $persona->save(); //save para almacenar el objeto categoria en la tabla categoria de la DB
        return redirect()->to('ventas/cliente'); //luego de almacenar con save el objeto, redirecciona a todas las categorias a la vista en la carpeta almacen subcapeta categoria
    }
    public function show($id) //id de la categoria q kiero mostrar
    {
       $persona = Persona::findOrFail($id);
        return view("ventas.cliente.index",compact("persona")); //llama a la vista show y pidele q muestre la categoria q indica el id

    }
    public function edit($id)
    {
        $persona = Persona::findOrFail($id);

        return view("ventas.cliente.edit",compact("persona")); 
    }
    public function update(PersonaFormRequest $request, $id) //todos los datos q kiera modificar los voy a validar con el request y el id de la categoria q kiero modificar
    {
    	$persona=Persona::findOrFail($id);
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');    	
        $persona->update(); //modifiq los datos de la categoria
        //return Redirect::to('almacen/categoria'); //redirecciono a la vista index
    	return redirect()->to('ventas/cliente'); //redirecciono a la vista index
    }
    public function destroy($id)
    {
    	$persona=Persona::findOrFail($id);//cambio para q no se muestre en todas las categorias y se modifiq con el id q recibo por parametro
    	$persona=Persona::findOrFail($id);
    	$persona->tipo_persona='Inactivo';
    	$persona->update();
    	return back();

    } //
}
