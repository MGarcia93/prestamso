<?php 

	class clsFunciones{

		public function cuotas($datos){
			$resultado=$this->inicializar(12);
			while ($fila=$datos->fetch_assoc()){
				$i=$fila['ESTADO'];
				for ($i;$i<=$fila['DURACION'];$i++){

					$m=$this->numMes($fila['FECHA'],$i);
					$resultado[$m]+=(int)$fila['CUOTAS'];
				}
			}
			return $resultado;
		}

		public function inicializar($cant){
			for($i=1;$i<=$cant;$i++){
				$resultado[$i]=0;
			}

			return $resultado;
		}

		public function numMes($fecha,$n){
		
			if ($fecha[5]=='0'){
				$m=(int)$fecha[6]+$n;
			}
			else{
				$m= (int)($fecha[5] . $fecha[6]) + $n;
			}
			if($m>12){
				$m-=12;
			}
			return $m;
		}

		public function mes($num){
			switch ($num) {
				case '1':
					$m="ENERO";
					break;
				case '2':
					$m="FEBRERO";
					break;
				case '3':
					$m="MARZO";
					break;
				case '4':
					$m="ABRIL";
					break;
				case '5':
					$m="MAYO";
					break;
				case '6':
					$m="JUNIO";
					break;
				case '7':
					$m="JULIO";
					break;
				case '8':
					$m="AGOSTO";
					break;
				case '9':
					$m="SEPTIEMBRE";
					break;
				case '10':
					$m="OCTUBRE";
					break;
				case '11':
					$m="NOVIEMBRE";
					break;
				case '12':
					$m="DICIEMBRE";
					break;
			}
			return $m;
		}

		public function fechaActual(){
			$fecha=getdate();
			return $fecha;
		}
	}
 ?>