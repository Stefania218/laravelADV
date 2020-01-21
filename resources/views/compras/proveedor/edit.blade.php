@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    		<h3>Editar Proveedor: {{ $persona->nombre}}</h3>
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

    		{!!Form::model($persona,['method'=>'put','route'=>['compras.proveedor.update',$persona->idPersona]])!!}
    		{{Form::token()}}
        <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$persona->Nombre}}" class="form-control" placeholder="Nombre...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="nombre">Direccion</label>
                <input type="text" name="direccion" value="{{$persona->Direccion}}" class="form-control" placeholder="Dirección...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label>Documento</label>
                <select name="tipo_documento" class="form-control">
                   @if ($persona->Tipo_documento=='DNI')
                     <option value="DNI" selected>DNI</option>
                     <option value="DOC">DOC</option>
                     <option value="PAS">PAS</option>
                   @elseif ($persona->Tipo_documento=='DOC')
                     <option value="DNI">DNI</option>
                     <option value="DOC" selected>DOC</option>
                     <option value="PAS">PAS</option>
                   @else 
                     <option value="DNI">DNI</option>
                     <option value="DOC">DOC</option>
                     <option value="PAS" selected>PAS</option> 
                   @endif
                </select>
             </div>
        </div>
         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="num_documento">Número de documento</label>
                <input type="text" name="num_documento" value="{{$persona->Num_documento}}" class="form-control" placeholder="Número de documento...">
            </div>
        </div> 
         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" value="{{$persona->Telefono}}" class="form-control" placeholder="Teléfono...">
            </div>
        </div> 
         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{$persona->Email}}" class="form-control" placeholder="Email...">
            </div>
        </div> 
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        </div>
    </div>   	
    		{!!Form::close()!!}
@endsection