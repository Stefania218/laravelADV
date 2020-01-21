<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;
use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {

    }//constructor
    public function index(Request $request)
    {

    	if($request)
    	{
    		$query=trim($request->get('searchText')); //almaceno todo en query y el trim dice q no dejo espacios en blanco
    		$articulos=DB::table('articulo as a')
    		->join('categoria as c','a.idCategoria','=','c.idCategoria')
    		->select('a.idArticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
    		->where('a.nombre','LIKE','%'.$query.'%')  
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('a.idarticulo','desc')
            ->paginate(7);
    		return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]); //enviamos todas las categorias en un parametro llamado categoria y el texto de busqueda en un parametro llamada searchText.
            ////el nombre de la tabla categoria inicia y finaliza con la cadena query
            
    	}

    }
    public function create()
    {

    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return view("almacen.articulo.create",["categorias"=>$categorias]);

    }
    public function store(ArticuloFormRequest $request)
    {
        $articulo=new Articulo;//objeto modelo q hace referencia al modelo categoria
    	$articulo->idCategoria=$request->get('idCategoria');
    	$articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';

        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }

    	$articulo->save(); //save para almacenar el objeto categoria en la tabla categoria de la DB
    	return redirect()->to('almacen/articulo');

    }
    public function show($id) //id de la categoria q kiero mostrar
    {
        $articulo = Articulo::findOrFail($id);
    	return view("almacen.articulo.index",compact("articulo")); //llama a la vista show y pidele q muestre la categoria q indica el id
    }
    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]); 
    }
    public function update(ArticuloFormRequest $request, $id) //todos los datos q kiera modificar los voy a validar con el request y el id de la categoria q kiero modificar
    {
    	$articulo=Articulo::findOrFail($id);
    	//objeto modelo q hace referencia al modelo categoria
    	$articulo->idCategoria=$request->get('idCategoria');
    	$articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';

        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        }
    	$articulo->update(); //modifiq los datos de la categoria
        //return Redirect::to('almacen/categoria'); //redirecciono a la vista index
    	return redirect()->to('almacen/articulo'); //redirecciono a la vista index
    }
    public function destroy($id)
    {
    	$articulo=Articulo::findOrFail($id);//cambio para q no se muestre en todas las categorias y se modifiq con el id q recibo por parametro
    	$articulo->estado='Inactivo';
    	$articulo->update();
    	return back();

    }
}
