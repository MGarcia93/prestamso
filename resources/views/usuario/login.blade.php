<form action="{{ route('usuario.validation')}}" method="post">
		<fieldset>
			<legend> LOGIN </legend>
			@csrf
			<input type="text" name="user"  required placeholder="usuario" autofocus autocomplete="off">
			<input type="password" name="pass" required placeholder="contraseña" >
			<input type="submit" name="boton" value="INGRESAR">
			<input type="submit" name="boton" value="VOLVER" >
		</fieldset>
	</form>
