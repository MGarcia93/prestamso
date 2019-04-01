@extends("layout/app")
@section('contenido')
<form action="{{ route('usuario.store')}}" method="POST">
	@csrf
	<label for="name">nombre:</label>
	<input type="text" name="usuario" id="name">
	<label for="pass">password:</label>
	<input type="password" name="pass" id="pass">
	<input type="submit" name="agregar" value="AGREGAR">
</form>
@stop