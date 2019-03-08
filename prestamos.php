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
            require_once("funciones.php");
            $base=new clsConexion;
            $conexion=$base->conexion();
            $consultas= new clsConsultas;
            $funciones=new clsFunciones;
         ?>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
    <body class="fondo">
        <?php 
            include ("modulo_encabezado.php");
         ?>
         <section class="bordes-bot tam contenido prestamos">
            <article class="prestamos__modificar">
                    <fieldset>
                        <legend> MODIFICACION</legend>
                        <input type="text" name="num" id="nombre" required>
                        <input type="button" name="Buscar" onclick="abrirVentana('modprestamo.php')" value="buscar">
                    </fieldset>
            </article>
            <article class="prestamos__separacion"></article>
            <article class="prestamos__resumen">
                <table>
                    <tr>
                        <th colspan="3"> RESUMEN</th>
                    </tr>
                    <tr class="prestamos__encabezados">
                        <td>MES</td>
                        <td>CANTIDAD</td>
                    </tr>
                    <?php
                        $datos=$consultas->buscarCuotas($conexion);
                        $cuotas=$funciones->cuotas($datos);
                        $fechaActual=$funciones->fechaActual();
                        $i=$fechaActual['mon'];
                        $cont=1;
                        $total=0;
                        while ($cont<count($cuotas)){
                            if ($i>12){
                                $i-=12;
                            }
                            if ($cuotas[$i]!=0){
                                echo "<tr>
                                        <td>". $funciones->mes($i)."</td>
                                        <td>$". $cuotas[$i]."</td>
                                      </tr>";
                            }
                            $total+=$cuotas[$i];
                            $i++;
                            $cont++;
                            
                        }
                        echo "<tr>
                               <th> TOTAL</th>
                               <th> \$ $total</th>
                              </tr>";
                    ?>
                </table>
            </article>

            <article class="prestamos__lista">
                <table>
                    <tr>
                        <th colspan="8">
                            LISTA DE PRESTAMOS EN CURSOS
                        </th>
                    </tr>
                    <tr class="prestamos__encabezados">
                        <td>N°</td>
                        <td>CLIENTE</td>
                        <td>MONTO</td>
                        <td>DUARION</td>
                        <td>COUTAS</td>
                        <td>ESTADO</td>
                        <td>PROXIMO PAGO</td>
                        <td>DEBE</td>
                    </tr>
                    <?php
                        $datos=$consultas->prestamosActivos($conexion);
                        while ($fila=$datos->FETCH_ASSOC()) {
                            $debe=$fila['MONTONUM'] - ($fila['ESTADO']-1)*$fila['CUOTAS'];
                            echo "<tr>";
                            echo "<td>".$fila['ID']."</td>";
                            echo "<td>".$fila['NOMBRE']."</td>";
                            echo "<td>".$fila['MONTONUM']."</td>";
                            echo "<td>".$fila['DURACION']."</td>";
                            echo "<td>".$fila['CUOTAS']."</td>";
                            echo "<td>".$fila['ESTADO']."</td>";
                            $siguiente=$fila['ESTADO'];
                            echo "<td>".$funciones->mes($funciones->numMes($fila['FECHA'],$siguiente))."</td>";
                            echo "<td>\$$debe</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
                
            </article>
         </section>
         
    </body>
    <script>
             function abrirVentana(url) {
                var valor =document.getElementById("nombre").value;
                if (valor) {
                    url+="?buscar="+ valor;
                    window.open(url,"modificar","width=300, height=250,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0");
                }
            }
         </script>
</html>