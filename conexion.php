<?php
	 class clsConexion{
	 	private $server;
	 	private $user;
	 	private $pass;
	 	private $nameDB;
	 	#constructor con las inicializacion a los datos de conexcion
	 	#----------------------------------------
	 	public function conexion(){
	 		$this->server="localhost";
	 		//servidor
	 		/*
	 		$this->user="u441935772_admin":
	 		$this->pass="32geda666";
	 		$this->nameDB="u441935772_prest"
			*/

	 		//local
	 		
	 		$this->user="root";
	 		$this->pass="";
	 		$this->nameDB="prestamo";
	 		
	 		$conexcion= new mysqli($this->server, $this->user, $this->pass,$this->nameDB);
	 		if ($conexcion->connect_errno){
	 			echo "error  en conexcion a base de dato";
	 		} 
	 		$conexcion->set_charset("utf8");
	 		return $conexcion;
	 	}
	}
?>
