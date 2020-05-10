@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<h3>Nuevo Ingreso</h3>
    		@if (count($errors)>0)
            <div class="alert alert-danger">
            	<ul>

            	@foreach ($errors->all() as $error)
                
            		<li>{{$error}}</li>
            	@endforeach
            	</ul>
            </div>
            @endif
        </div>
    </div>    
            {!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}  
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
             <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
                    @foreach($personas as $persona)
                    <option value="{{$persona->idPersona}}">{{$persona->Nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
             <div class="form-group">
                <label>Tipo Comprobante</label>
                <select name="tipo_comprobante" class="form-control">
                     <option value="Boleta">Boleta</option>
                     <option value="Factura">Factura</option>
                     <option value="Ticket">Ticket</option>
                </select>
             </div>
        </div>
         <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Serie Comprobante</label>
                <input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie Comprobante...">
            </div>
        </div>
                 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
            <div class="form-group">
                <label for="serie_comprobante">Número Comprobante</label>
                <input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Número Comprobante...">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Artículo</label>
                        <select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
                            @foreach($articulos as $articulo)
                            <option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                       <label for="cantidad">Cantidad</label>
                       <input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad"> 
                    </div>
                </div>
                 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                       <label for="precio_compra">Precio Compra</label>
                       <input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Pre. Compra"> 
                    </div>
                </div>
                 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                       <label for="cantidad">Precio Venta</label>
                       <input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Pre. Venta">
                    </div>
                </div>
                 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                      <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Opciones</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total">S/. 0.00</h4></th>
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
             <div class="form-group">
                <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>   

           
            {!!Form::close()!!} 

@push ('scripts')
<script> //permite q el boton agregue a la tabla de ingreso cada vez q se hace click
    $(document).ready(function(){
        //boton bt_add de la linea 89 arriba
        $('#bt_add').click(function(){
            agregar();
        });
    });

    var cont=0;
    total=0;
    subtotal=[]; //para guardar todos los subtotales. hide es ocultar
    $("#guardar").hide();

    function agregar(){ //las dos primeras lineas significa q selecciono el texto del id del articulo q esta seleccionado
        idarticulo=$("#pidarticulo").val();
        articulo=$("#pidarticulo option:selected").text();//no kiero el valor sino el texto seleccionado por eso dice text
        cantidad=$("#pcantidad").val();
        precio_compra=$("#pprecio_compra").val();
        precio_venta=$("#pprecio_venta").val();

        //valido q nada este vacio. calcula subtotales y total
        if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!=""){
            subtotal[cont]=(cantidad*precio_compra);//va calculando los subtotales uno por uno, el cont va cambiando 
            total=total+subtotal[cont];

            //el primer buton permite eliminar la fila especifica. todo en una sola linea. name="idarticulo[]" <- array de controles o sea de idarticulo. el signo + es concatenar
            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
            cont++;
            //limpiar para dejar vacias las cajas e ingresar nuevos valores
            limpiar();
            $("#total").html("S/. " + total);
            //en esas dos lineas digo q agregue la fila q esta en var fila q es codigo html
            evaluar();
            $('#detalles').append(fila);
        }
        else{
            alert("Error al ingresar el detalle del ingreso, revise los datos del artículo");
        }
    }

    //permite q el boton limpiar de ingreso, limpie
    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio_compra").val("");
        $("#pprecio_venta").val("");
    }
 
    //para no guardar algo vacio. si no tiene detalle estara oculto el boton
    function evaluar(){
        if (total>0){
            $("#guardar").show();
        }
        else{
            $("#guardar").hide();
        }
    }

    //cdo hago click en la x llamo a la funcion eliminar y le envio un parametro q elimine y despues calcula el subtotal y actualizo el total
    function eliminar(index){
        total=total-subtotal[index];
        $("#total").html("S/. " + total);
        $("#fila" + index).remove();//remuevo la fila
        evaluar();//evaluo si el total es mayor a 0
    }

</script> 
@endpush   	
@endsection

