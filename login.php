<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Presmos J&L</title>
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="css/styleL.css">
	<?php
		require("conexion.php");
	    $conexion=new clsConexion;
	?>
</head>
<body class="fondo">
	<header class="titulo">
		<h1> Prestamos J&L</h1>
	</header>
	<form action="" method="post">
		<fieldset>
			<legend> LOGIN </legend>
			
			<input type="text" name="user"  required placeholder="usuario" autofocus autocomplete="off">
			<input type="password" name="pass" required placeholder="contraseña" >
			<input type="submit" name="boton" value="INGRESAR">
			<input type="submit" name="boton" value="VOLVER" >
		</fieldset>
	</form>
	<?php

		if (isset($_POST["user"]))
		{ 
			if($_POST["boton"]=="VOLVER"){
				header("location:index.html");
			}
			require("consultas.php");
			$consulta =  new clsConsultas;
			if ($consulta->login($_POST["user"],$_POST["pass"],$conexion->conexion())){
				session_start();
				$_SESSION['usuario']=$_POST["user"];
				header('Location: menu.php');
			}
			else{
				echo "<section style='text-align:center; font-size:1.5em'> Usuario a contraseña incorrecto</section>";
			}
		}


	?>
</body>
</html>