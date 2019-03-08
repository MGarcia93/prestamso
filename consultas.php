<?php 
	
	class clsConsultas{

		public function login($user,$pass,$conexion){
	 		$consulta="SELECT PASS FROM login WHERE USER=?";
	 		if ($resultado=$conexion->prepare($consulta)){
	 			$resultado->bind_param("s",$user);
	 			$resultado->execute();
	 			$resultado->bind_result($password);
	 			$resultado->fetch();
	 			echo "numero de columnas" . $resultado->num_rows;
	 	 		if ($password==$pass){
	 	 			$resultado->close();
		 			return true;

		 		}
		 	}
		 	$resultado->close();
		 	return false;
	 	}

	 	// BUSCA UN CLIENTE 
	 	//----------------------------------------------------------
	 	public function buscarClientes($buscar, $conexion){
	 		$consulta="SELECT * FROM clientes WHERE NOMBRE like ? OR ID=?";
	 		$resultado=$conexion->prepare($consulta);
	 		if ($resultado) {
	 			
	 			$resultado->bind_param("ss",$buscar,$buscar);
	 			$resultado->execute();
	 			$resultado->store_result();
	 			if ($resultado->num_rows>0)
	 			{
	 				return $resultado;
	 			}
	 			else
	 			{
	 				$resultado->close();
	 				return false;
	 			}
	 		}
	 		$conexion->close();
	 	}


	 	//INGRESA UN NUEVO CLIENTE A LA BASE DE DATOS
	 	//--------------------------------------------------------------
	 	public function nuevoCliente($nombre,$dni,$fechaNac,$direccion,$telefono, $conexion){
	 		
	 		$consulta=$conexion->query("SELECT DNI FROM clientes WHERE DNI='$dni'");
	 		if ($consulta->num_rows>0){
	 			return -1;
	 		}
	 		$conexion->query("INSERT INTO clientes (NOMBRE,DNI,FECHANAC,DIRECCION,TELEFONO) VALUES ('$nombre','$dni','$fechaNac','$direccion','$telefono')");
			if($conexion->affected_rows==1){
				return 1;
			}
			else{
				return 0;
			}
	 	}
	 	// ACTUALIZAR DATOS DEL CLIENTE CLIENTE 
	 	//----------------------------------------------------------
	 	public function clienteActualizar($id,$nombre,$dni,$fecha,$direccion,$telefono,$conexion){
		 	$sql="UPDATE clientes SET NOMBRE='$nombre',DNI='$dni',FECHANAC='$fecha',DIRECCION='$direccion',TELEFONO='$telefono' WHERE ID = '$id'";
		 	
		 	if ($conexion->query($sql)){
		 		if ($conexion->affected_rows)
		 			return 1;
		 		else
		 			return 0;
		 	}
		 	else{
		 		return -1;
		 	}
		 }
	 	// ELIMINAR UN CLIENTE 
	 	//----------------------------------------------------------
	 		public function eliminarCliente($conexion,$id){
	 			$consulta=$conexion->query("DELETE FROM clientes WHERE ID='$id'");
	 			if ($conexion->affected_rows!=0){
					return true;
				}
				else{
					return false;
				}
	 		}
	 	/* METODOS PARA LA CREACION DE UN NUEVO PRESTAMOS
	 	------------------------------------------------------------------------------*/
	 	public function nuevoNumPrestamo($conexion){
	 		$consulta=$conexion->query("SELECT MAX(ID) AS ultimo FROM prestamos");
	 		$fila=$consulta->fetch_assoc();
	 		return $fila['ultimo']+1;
	 	}

	 	public function tienePrestamo($idCliente,$conexion){
	 		$consulta=$conexion->query("SELECT DURACION,ESTADO,FECHA FROM prestamos WHERE IDCLIENTE='$idCliente' and ESTADO !='T'");
	 		if($consulta->num_rows !=0){	
	 			echo "encontor <br>"; 			
	 			return $consulta;
	 		}
	 		else{
	 			return false;
	 		}

	 	}

	 	public function generarPrestamo($numero,$fecha,$prestador,$idCliente,$montoN,$montoL,$duracion,$cuotas,$estado,$conexion){
	 		echo 'entro a la consulta <br>';

	 		if ($resultado=$conexion->prepare(
	 			"INSERT INTO prestamos( ID,FECHA, PRESTADOR, IDCLIENTE, MONTONUM, MONTOLETRA, DURACION, CUOTAS, ESTADO) VALUES (?,?,?,?,?,?,?,?,?)")){ 

	 			echo 'preparo la consulta <br>';
				$resultado->bind_param("issiisiis",$numero,$fecha,$prestador,$idCliente,$montoN,$montoL,$duracion,$cuotas,$estado);
				$resultado->execute();
				if ($resultado->affected_rows){
					return true;
				}
				else{
					return false;
				}
	 		}
	 		else {
	 			echo "error en prepare";
	 		}

	 		
		}

		//----------------------------------------------------------------------------------------------------------


		/* METODO QUE DEVUELVE TODOS L0S MONTOS POR CUOTAS SI EL PRESTAMOS NO ESTA TERMINADO
		-----------------------------------------------------------------------------------*/
		public function buscarCuotas($conexion){
			$sql="SELECT  `FECHA`,`DURACION`, `CUOTAS`, `ESTADO` FROM `prestamos` WHERE `ESTADO` !='T'";
			$resultado=$conexion->query($sql) ;
			if ($resultado){
				return $resultado;
			}
			else{
				return false;
			}
			
		}

		/* METODO QUE DEVUELVE TODOS L0S PRESTAMOS NO ESTA TERMINADO
		-----------------------------------------------------------------------------------*/
		public function prestamosActivos($conexion){
			$sql="SELECT prestamos.ID, clientes.NOMBRE, prestamos.MONTONUM, prestamos.DURACION, prestamos.CUOTAS, prestamos.ESTADO, prestamos.FECHA FROM prestamos LEFT JOIN clientes ON prestamos.IDCLIENTE=clientes.ID WHERE prestamos.ESTADO!='T'";
			$resultado=$conexion->query($sql);
			if ($resultado){
				return $resultado;
			}
			else{
				return false;
			}
		}

		/* METODO QUE BUSCA PRESTAMO POR DNI O POR NUMERO
		-----------------------------------------------------------------------------------*/
		public function prestamosBuscar($conexion,$dato){
			$sql="SELECT prestamos.ID,prestamos.FECHA, prestamos.PRESTADOR, clientes.DNI, prestamos.MONTONUM,prestamos.MONTOLETRA, prestamos.DURACION, prestamos.CUOTAS, prestamos.ESTADO FROM prestamos LEFT JOIN clientes ON prestamos.IDCLIENTE=clientes.ID WHERE prestamos.ESTADO!='T' AND (clientes.DNI='$dato' OR prestamos.ID='$dato')";
			$resultado=$conexion->query($sql);
			if ($resultado){
				return $resultado;
			}
			else{
				return false;
			}
		}

		/* METODO QUE BUSCA el id del cliente atraves de su DNI
		-----------------------------------------------------------------------------------*/
		public function idCliente($dniCliente,$conexion){
			$consulta=$conexion->query("SELECT ID FROM clientes WHERE DNI='$dniCliente'");
			if ($consulta){
				$fila=$consulta->fetch_assoc();
				return $fila['ID'];
			}
			else{
				return false;
			}
		}


		/* METODO  QUE ACTUALIZA LOS DATOS DEL PRESTAMO
		-----------------------------------------------------------------------------------*/
		public function prestamoActualizar($id,$dniCliente,$montoN,$montoL,$duracion,$cuotas,$estado,$conexion){
		 	$idCliente=$this->idCliente($dniCliente,$conexion);
		 	if (!$idCliente){
		 		return false;
		 	}
		 	$sql="UPDATE prestamos SET IDCLIENTE = '$idCliente',MONTONUM = '$montoN',MONTOLETRA = '$montoL', DURACION = '$duracion', CUOTAS = '$cuotas', ESTADO = '$estado' WHERE ID = '$id'";
		 	
		 	if ($conexion->query($sql)){
		 		if ($conexion->affected_rows)
		 			return 1;
		 		else
		 			return 0;
		 	}
		 	else{
		 		return -1;
		 	}
		 }


		 /* METODO QUE ELIMINA UN PRESTAMO
		-----------------------------------------------------------------------------------*/
		 public function prestamoEliminar($id,$conexion){
		 	$conexion->query("DELETE FROM `prestamos` WHERE ID='$id'");
		 	if ($conexion->affected_rows) {
		 		return true;
		 	}
		 	else {
		 		return false;
		 	}
		 }




		 public function fecha($conexion){
		 	$sql=$conexion->query("SELECT FECHA FROM prestamos");
		 	echo "trajo fecha";
		 	$fila=$sql->fetch_assoc();
		 	return $fila['FECHA'];
		 }
	}

?>
