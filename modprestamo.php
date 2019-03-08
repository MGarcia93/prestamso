<!doctype html>
<html>
<head>
     <meta charset="utf-8">
    <title>Prestamos</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
     <?php 
            session_start();
            if (!isset($_SESSION['usuario'])) {
                header ('location:login.php');
            }
            require_once("conexion.php");
            require_once("consultas.php");
            require_once("funciones.php");
            $base=new clsConexion;
            $conexion=$base->conexion();
            $consultas= new clsConsultas;
            $funciones=new clsFunciones;
         ?>
</head>
<body class="fondo">
	<section class=".mod">
		<?php
			if (isset($_GET['buscar'])){
				echo"<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST'>";
				$datos=$consultas->prestamosBuscar($conexion,$_GET['buscar']);
				if ($datos){
					while ($fila=$datos->FETCH_ASSOC()) {
							echo "<table>";
	                      	echo "<tr>
                        		  <td>N°</td>
                        		  <td> <input type='text' value='".$fila['ID']."' name='id' disable ></td></tr>";
	                        echo "<tr>
	                        	  <td>CLIENTE</td>
	                        	  <td><input type='text' value='".$fila['DNI']."' name='idCliente'></td></tr>";
	                      	echo "<tr>
	                      		<td>MONTO</td>
	                      		<td><input type='text' value='".$fila['MONTONUM']."' name='montoN'></td></tr>";
	                      	echo "<tr>
	                      		<td>MONTO</td>
	                      		<td><input type='text' value='".$fila['MONTOLETRA']."' name='montoL'></td></tr>";
	                        echo "<tr>
	                      		<td>DURACION</td>
	                      		<td><input type='text' value='".$fila['DURACION']."' name='duracion'></td></tr>";
	                        echo "<tr>
	                      		<td>CUOTAS</td>
	                      		<td><input type='text' value='".$fila['CUOTAS']."' name='cuotas'></td></tr>";
	                        echo "<tr>
	                      		<td>CUOTAS</td>
	                      		<td><select name='estado'>";
	                       	$i=1;
	                       	while ($i<=$fila['DURACION']){
	                        	echo "<option value='$i' ";
	                        	if ($i==$fila['ESTADO']){
	                        		echo "selected";
	                        	}
	                        	echo ">".$i."</option>";
	                        	$i++;
	                    	}
	                    	echo "<option value='T'> T </option> </selected></td>";
	                        echo "</tr>";					
	                        echo "</table>";
	                        echo "<input type='submit' name='accion' value='actualizar'>";
							echo "<input type='submit' name='accion' value='eliminar'>";
							echo "</br>";
	                 }
	                 echo "</table>";
	            }
				else{
					echo "<script>
					window.opener.location.reload();
					window.close();
					<script>"; 
				}
			}
			if (isset($_POST['accion'])){
				if($_POST['accion']=='actualizar'){
					$resultado=$consultas->prestamoActualizar($_POST['id'],$_POST['idCliente'],
						$_POST['montoN'],$_POST['montoL'],$_POST['duracion'],$_POST['cuotas'],
						$_POST['estado'],$conexion);
					if ($resultado==0){
						echo "NO SE REGISTRARON CAMBIOS";
					}
					elseif ($resultado==1){
						echo "ACTUALIZADO";
						echo "<script>
						window.opener.location.reload();
						window.close();
						<script>"; 
					}
					else{
						echo "NO SE PUDO ACTUALIZAR";
					}
				}
				else{
					$resultado=$consultas->prestamoEliminar($_POST['id'],$conexion);
					if ($resultado){
						echo "PRESTAMO ELIMINADO";
					}
					else{
						echo "NO SE PUDO ELIMINAR";
					}
				}
			}
			?>

		</form>

	</section>
</body>
</html>