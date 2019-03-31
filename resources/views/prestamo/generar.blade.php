@extends("layout/app")
@section('contenido')
<section class="generarCom">
	@if(app('request')->input('save')==1)
		<p>PRESTAMO GENERADO</p>
	@endif
	<form action="{{ action('prestamoController@store')}}" method="post" name="generarPrestamo">
		@csrf
		
        <table>
            <tr> <th colspan="2"> DATOS DEL PRESTAMO</th></tr>
			<tr>
				<td>
					N° DE PRESTAMO:
				</td>
				<td>
					<input type='text' name='numPrestamo' value="{{$id}}" disabled>
				</td>
			</tr>
			<tr>
				<td>FECHA:</td>
				<td><input type="date" name="fechaPrestamo" autocomplete="off" required></td>
			</tr>
			<tr>
				<td>PRESTADOR:</td>
				<td><input type="text" name="prestador" required></td>
			</tr>
			<tr>
				<td>CANTIDAD EN NUMERO:</td>
				<td>
					<input type="number" name="cantNumero" autocomplete="off" required>
				</td>
			</tr>
			<tr>
				<td>CANTIDAD EN LETRA:</td>
				<td><input type="text" name="cantLetra" autocomplete="off" required></td>
			</tr>
			<tr>
				<td>DURACION: </td>
				<td><input type="num" name="duracion" autocomplete="off" required></td>
			</tr>
			<tr>
				<td>CUOTAS:</td>
				<td> <input type="number" name="cuotas" required></td>
			</tr>
		</table>
		<table>
			<tr> <th colspan="2"> DATOS DEL CLIENTE</th></tr>
			<tr>
				<td>NOMBRE:</td>
				<td>
					<select name="cliente" required id="idCliente">
						<option> -
						@foreach ($clientes as $cliente)
						<option value='{{$cliente->ID}}'>{{$cliente->NOMBRE}}</option>	
						@endforeach
						
					</select>	
				</td>
			</tr>
			<tr>
				<td>DNI:</td>
				<td><input type="text" name="dniCliente" autocomplete="off" disabled id="dni"></td>
			</tr>
		</table>
	<div> <input type="submit" name="generar" value="GENERAR"></div>
	</form>
</section>

@endsection
@section('script')
<script type="text/javascript">
	var cliente=document.querySelector("#idCliente");
	console.log(cliente.value);
	cliente.addEventListener("change",function(e){
		console.log("cambio");
		var dni=document.querySelector("#dni");
		fetch('/cliente/'+cliente.value, {
		  method: 'get'
		}).then(function(respuesta) {
		  return respuesta.json();
		}).then(function(data){
			dni.value=data["DNI"];
		})
		.catch(function(err) {
			dni.value=""
		});
	});
</script>
@stop