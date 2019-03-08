<!doctype html>
<html>
    <head>
        <title>Prestamos</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
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
        ?>

    </head>
    <body class="fondo">
        <?php 
            include ("modulo_encabezado.php");
        ?>
        <section class="generarCom bordes-bot tam contenido">
        <?php
        	if (isset($_GET['generado']))
        		echo "<p>PRESTAMO GENRADO</p>";
        ?>
        <form action=<?php echo"\"".htmlentities($_SERVER['PHP_SELF'])."\"";?> method="post" name="generarPrestamo">
        <table>
            <tr> <th colspan="2"> DATOS DEL PRESTAMO</th></tr>
			<tr>
				<td>
					N° DE PRESTAMO:
				</td>
				<td>
					<?php
					$numero=$consultas->nuevoNumPrestamo($conexion);
					echo "<input type='text' name='numPrestamo' value='$numero' disabled>";
					?>
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
					<select name="cliente" required onchange="cambiarDni()" id="idCliente">
						<option> -
						<?php
							$buscar='%_%';
							$resultado=$consultas->buscarClientes($buscar,$base->conexion());
							if ($resultado!=false) {
								$resultado->bind_result($id,$nombre,$dni,$fecha,$dir,$tel);
								while ($resultado->fetch()){
									$valor['$id']=$dni;
									echo "<option value='$id'>" .$nombre;
								}
							}
						?>
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
	<?php 
		if (isset($_POST['generar'])){
			$idCliente=$_POST['cliente'];
			$puede=true;
			$fecha=$_POST['fechaPrestamo'];
			echo "sa";
			if ($resultado=$consultas->tienePrestamo($idCliente,$conexion))
			{

				require_once("funciones.php");
				$funciones= new clsFunciones;
				$fila=$resultado->fetch_assoc();
				// mes y dia del prestamo a generar
				$mes=$fecha[5].$fecha[6];
				$anio=$fecha[2].$fecha[3];

				//mes y dia del prestamo antiguo
				$fechaantigua=$fila['FECHA'];
				$anioTermina= $fechaantigua[2].$fechaantigua[3];
				$mesGenero=$fechaantigua[5].$fechaantigua[6];
				$mesTermina=$funciones->numMes($fila['FECHA'],$fila['DURACION']);

				echo "temina ". $anioTermina."<br>	";
				if ($mesGenero>$mesTermina){
					$anioTermina++;
				}
				echo "temina ". $anioTermina."-".$mesTermina ." fecha ".$anio. "-". $mes;
				if ( $anioTermina>$anio  or ($mesTermina>$mes and $anio==$anioTermina) ){
					echo "<script> alert('El cliente tiene un prestamo activo que se termina en ".$funciones->mes($funciones->numMes($fila['FECHA'],$fila['DUARACION'])).". de por terminado este prestamo para hacer el siguiente o genere un prestamo con fecha del mes en que termina este prestamo') </script>";
					$puede=false;
				}	
			}
			if ($puede=true){
				$prestador=$_POST['prestador'];
				$numero=$consultas->nuevoNumPrestamo($conexion);
				//$idCliente=$consultas->buscarIdClientes($_POST['cliente'],$conexion);
				$idCliente=$_POST['cliente'];
				$montoN=$_POST['cantNumero'];
				$montoL=$_POST['cantLetra'];
				$duracion=$_POST['duracion'];
				$cuotas=$_POST['cuotas'];
				$estado='1';
				echo "<p>sia<p>";
				if ($consultas->generarPrestamo($numero,$fecha,$prestador,$idCliente,$montoN,$montoL,$duracion,$cuotas,
					$estado,$conexion)){

					header("location:generar.php?generado=s/",300);
				}
				else{
					echo "<p> No se pudo generar eL prestamo, intentelo de nuevo </p>";	
				}
			}
			
		}
	?>
    </section>
    </body>
    <script type="text/javascript">
    	function cambiarDni(){
    		var id = document.getElementById("idCliente");
			var valor = id.options[id.selectedIndex].value;
    		document.getElementById(“dni”).value = valor;
    	}
    </script>
</html>