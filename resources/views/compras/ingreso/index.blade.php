@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    	<h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
    	@include('compras.ingreso.search')
    </div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
				<th>Fecha</th>
				<th>Proveedor</th>
				<th>Comprobante</th>
				<th>Impuesto</th>
				<th>Total</th>
				<th>Estado</th>
				<th>Opciones</th>		
			</thead>
			@if(!empty($ingresos))
			
            @foreach ($ingresos as $ing) 
            
			<tr>
				<td>{{$ing->Fecha_hora}}</td>
				<td>{{$ing->Nombre}}</td>
				<td>{{$ing->Tipo_comprobante.': '.$ing->Serie_comprobante.'-'.$ing->Num_comprobante}}</td>
				<td>{{$ing->Impuesto}}</td>
				<td>{{$ing->Total}}</td>
				<td>{{$ing->Estado}}</td>
				<td>
					<a href="{{URL::action('IngresoController@show',$ing->idIngreso)}}"><button class="btn btn-primary">Detalles</button></a>
					<a href="{{URL::action('IngresoController@destroy',$ing->idIngreso)}}"><button class="btn btn-danger">Anular</button></a>
				</td>
			</tr>

            @endforeach
            @endif
			</table>
		</div>
			@if(isset($ingresos) && !empty($ingresos))
				{{$ingresos->render()}}
			@endif
	</div>
</div>

@endsection