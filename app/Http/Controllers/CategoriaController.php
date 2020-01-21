<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Categoria;
use Iluminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
{
    public function __construct()
    {

    }//constructor
    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText')); //almaceno todo en query y el trim dice q no dejo espacios en blanco
    		$categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            ->where ('condicion','=','1')  
            ->orderBy('idcategoria','desc')
            ->paginate(7);
    		return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]); //enviamos todas las categorias en un parametro llamado categoria y el texto de busqueda en un parametro llamada searchText.
            ////el nombre de la tabla categoria inicia y finaliza con la cadena query
    	}

    }
    public function create()
    {
        return view("almacen.categoria.create");//retorna la vista//retorna la vista

    }
    public function store(CategoriaFormRequest $request)
    {
    	$categoria=new Categoria;//objeto modelo q hace referencia al modelo categoria
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save(); //save para almacenar el objeto categoria en la tabla categoria de la DB
        return redirect()->to('almacen/categoria'); //luego de almacenar con save el objeto, redirecciona a todas las categorias a la vista en la carpeta almacen subcapeta categoria
    }
    public function show($id) //id de la categoria q kiero mostrar
    {
       $categoria = Categoria::findOrFail($id);
        return view("almacen.categoria.index",compact("categoria")); //llama a la vista show y pidele q muestre la categoria q indica el id

    }
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view("almacen.categoria.edit",compact("categoria")); 
    }
    public function update(CategoriaFormRequest $request, $id) //todos los datos q kiera modificar los voy a validar con el request y el id de la categoria q kiero modificar
    {
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nombre=$request->get('nombre');
    	$categoria->descripcion=$request->get('descripcion');
    	$categoria->update(); //modifiq los datos de la categoria
        //return Redirect::to('almacen/categoria'); //redirecciono a la vista index
    	return redirect()->to('almacen/categoria'); //redirecciono a la vista index
    }
    public function destroy($id)
    {
    	$categoria=Categoria::findOrFail($id);//cambio para q no se muestre en todas las categorias y se modifiq con el id q recibo por parametro
    	$categoria->condicion='0';
    	$categoria->update();
    	return back();

    }//elimina, destruye
    //con todo esto trabajamos con un controlador para q nos muestre una vista o va a interactuar con el modelo para enviar o consultar info.
}
