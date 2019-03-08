
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	session_start();
     if (!isset($_SESSION['usuario'])) {
        header ('location:login.php');
    }
    require_once("conexion.php");
    require_once("consultas.php");
    $base=new clsConexion;
    $conexion=$base->conexion();
    $consultas= new clsConsultas;
	$id=$_GET['cliente'];
	if ($_GET['accion']=='e'){
		if ($consultas->eliminarCliente($conexion,$id)){
			echo "cliente eliminado";			
		}
		else{
			echo "no se pudo eliminar";
		}
		echo "<input type='button' onclick='volver()' value='salir'>";
	}
	elseif ($_GET['accion']=='a'){

		$encontrados=$consultas->buscarClientes($id,$conexion);
		$encontrados->bind_result($id,$nombre,$dni,$fecha,$dir,$tel);
		$encontrados->fetch();
	?>
	<form action="" method='POST'>
		
	<table>
	<tr>
		<td>
			<label>NOMBRE</label>
			<input type="text" name="nombre" value="<?php echo $nombre; ?>">
		</td>
	</tr>
	<tr>
		<td>
			<label>DNI</label>
			<input type="text" name="dni" value="<?php echo $dni; ?>">
		</td>
	</tr>
	<tr>
		<td>
			<label>FECHA NAC</label>
			<input type="date" name="fecha" value="<?php echo $fecha; ?>">
		</td>
	</tr>
	<tr>
		<td>
			<label>DIRECCION</label>
			<input type="text" name="direccion" value="<?php echo $dir; ?>">
		</td>
	</tr>
	<tr>
		<td>
			<label>TELEFONO</label>
			<input type="text" name="telefono" value="<?php echo $tel; ?>">
		</td>
	</tr>
	<tr>
		<td>
			<input type="submit" name="actualizar" value="ACTUALIZAR">
		</td>
	</tr>
</table>
</form>
<?php 
	
	if(isset($_POST['actualizar'])){

		$resultado=$consultas->clienteActualizar($id,$_POST['nombre'],$_POST['dni'],$_POST['fecha'],$_POST['direccion'],$_POST['telefono'],$conexion);
		if ($resultado==0){
			echo "NO SE REGISTRARON CAMBIOS";
		}
		elseif ($resultado==1){
			echo "<h1>ACTUALIZADO</h1>";
		}
		echo "<input type='button' onclick='volver()' value='salir'>";
	}

 }
 ?>

 <script>
 	function volver(){
		window.opener.location.href="clientes.php";
		window.close();
 	}
 </script>
</body>
</html>
