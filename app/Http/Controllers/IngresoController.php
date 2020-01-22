<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\IngresoFormRequest;
use sisVentas\Ingreso;
use sisVentas\DetalleIngreso;
use DB;

use Carbon\Carbon;//para poder usar el formato fecha y hora de la zona horaria xq tabla ingreso tiene campo fecha y hora
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function __construct()
    {

    }//constructor
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText')); //trim para borrar espacios al inicio y al final. $ingresos significa q ingresos hara una consulta a la db a la tabla ingreso con ese i y va a unir la tabla ingreso con la tabla persona(de la tabla ingreso usa el idproveedor para ver si es igual al id persona de la tabla p q es la tabla persona). se hace otra union mas uniendo tabla detalle de ingreso con tabla ingreso, mediante los campos i de id de ingreso para ver si es igual al id de tabla detalle de ingreso. el select dice q de mi tabla ingreso quiero obtener el i de ingreso, la fecha y la hora, de la tabla persona p el nombre del proveedor y el tipo de comprobante de tabla ingreso etc. el where dice q la busqueda se hara por el campo num de comprobante de la tabla ingreso todo lo demas significa para buscar en cualquier lugar. order dice q se ordenara de manera descendente, los ingresos mas actuales apareceran primero. el return me dice q retorna la vista de compras con todos los ingresos y muestro el texto q filtro con search
    		$ingresos=DB::table('ingreso as i')
    		->join('persona as p','i.idproveedor','=','p.idpersona')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		//->where('i.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('i.idingreso','desc')
    		->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
    		->paginate(7);
            return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
    	$articulos=DB::table('articulo as art')
    	    ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo')
    	    ->where('art.estado','=','Activo')
    	    ->get();
    	 return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);

    }//hago una consulta a la tabla persona donde tipo de pers sea igual a proveed para q se muestre un listado con todos los provee y saber quien cual lo esta abasteciendo. la linea q sigue dice q se hace una consulta a la tabla articulo con alias art y seleccionando los campos con el medoto raw para concatenar el codigo con el nombre del articulo y mostrarlo en una sola columna tb con alias as articulo para q se muestren los articulos tb se necesita el idarticulo porq es lo q se almacena en la db. por ultimo retorna la vista create q me va a permitir crear el formulario enviando los proveedores y los articulos

    public function store (IngresoFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
            $ingreso=new Ingreso;
            $ingreso->idproveedor=$request->get('idproveedor');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->num_comprobante=$request->get('num_comprobante');

            $mytime = Carbon::now();
            $ingreso->fecha_hora=$mytime->toDateTimeString();
            $ingreso->impuesto='18';
            $ingreso->estado='A';
            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($idarticulo)){
            	$detalle = new DetalleIngreso();
            	$detalle->idingreso= $ingreso->idingreso;
            	$detalle->idarticulo= $idarticulo[$cont];
            	$detalle->cantidad= $cantidad[$cont];
            	$detalle->precio_compra= $precio_compra[$cont];
            	$detalle->precio_venta= $precio_venta[$cont];
            	$detalle->save();

            	$cont=$cont+1;
            }

    		DB::commit();

    	}catch(\Exception $e)
    	{
    		DB::rollback();
    	}

        return redirect()->to('compras/ingreso');


    }//funcion store almacenamos creando un objeto request de tipo ingresoformrequest para validar todo lo q se ingrese en ingreso y detalledeingreso. c usa un try catch capturador de excepciones, usamos dentro una transaccion xq tenemos q registrar el ingreso y detdiingreso pero tienen q almacenarse ambos xq puede haber algun prpblema en la red entonces se cancela la transaccion. $cont=0 es un contador para el array de articulos del detalledingreso. en el create <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> los cuatro 12 hace q por ejm el nombre del proveedor cubra toda una linea de la vista haciendo q los demas atributos deban bajar a la sig linea. mientras mas grande el numero mas cubre la linea.


    public function show($id)  
    {
    	$ingresos=DB::table('ingreso as i')
    		->join('persona as p','i.idproveedor','=','p.idpersona')
    		->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    		->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    		->where('i.idingreso','=',$id)
    		->first();

    	$detalles=DB::table('detalle_ingreso as d')
    		->join('articulo as a','d.idarticulo','=','a.idarticulo')
    		->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
    		->where('d.idingreso','=',$id)
    		->get();
        return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }//first es para q tome solo un ingreso el primero

    public function destroy($id)
    {
    	$ingreso=Ingreso::findOrFail($id);
    	$ingreso->Estado='C';
    	$ingreso->update();
    	return redirect()->to('compras/ingreso');
     }
}
