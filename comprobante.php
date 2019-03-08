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
</head>
<body class="fondo">
     <?php 
           include ("modulo_encabezado.php");
    ?>
     <section class="bordes-bot tam contenido">
        <article class="buscarComp">
            <form action=<?php echo"\"".htmlentities($_SERVER['PHP_SELF'])."\"";?> method="POST" >
                <fieldset>
                    <legend>Prestamo Imprimir</legend>
                    <label>Numero:</label>
                    <input type="text" name="numeroPrestamo">
                    <input type="submit" name="buscar">
                </fieldset>
            </form>
        </article>
        <?php
            if (isset($_POST['numeroPrestamo'])){
                $datos=$consultas->prestamosBuscar($conexion,$_POST['numeroPrestamo']);
                if($datos){
                    $prestamo=$datos->fetch_assoc();
                    $fecha=$prestamo['FECHA'];
                    $dia=$fecha[8].$fecha[9];
                    $mesanio=$fecha[0].$fecha[1].$fecha[2].$fecha[3].$fecha[4].$fecha[5].$fecha[6];
                echo" 
                    <section class=comprobante>
                    <article class='comprobante__concepto comprobate__position'>
                        <h3>Concepto</h3>
                        <h3>PRESTAMO</h3>
                        <h3> 
                            
                            <input type='text' value='$".$prestamo['MONTONUM']."' readonly>
                        </h3>
                    </article>   
                    <article class='comprobante__img comprobate__position'>
                       <img src=sello.jpg >
                    </article> 
                    <article class='comprobante__datos comprobate__position'>
                        <p >N°: <input type='text' value='".$prestamo['ID']."' name='numeroID' class=ralla size='1em' readonly>
                            <span class='right'>
                            <input type='numero' value='".$dia."'  size='1em' class='subrayado' readonly>
                                &nbsp de &nbsp
                            <input type='month' value='".$mesanio."' class='subrayado' readonly>
                            </span> 
                        </p>
                        <p>
                            RECIBI &nbsp &nbsp<strong> $ </strong> &nbsp &nbsp  de  &nbsp  
                            <input type='text' name='prestador' class=subrayado readonly value='".$prestamo['PRESTADOR']."'>
                        </p>
                        <p>
                            la cantidad de pesos &nbsp
                           <input type='text'  class='ralla' name='plata'value='".$prestamo['MONTONUM']." (".$prestamo['MONTOLETRA']." disabled)' class='ralla'>    
                                
                         </p>
                            <p class=ralla>
                                En concepto de préstamo a paga del 1 al 10 de cada mes.
                            </p>
                            <p class=subrayado>
                                DURANTE
                                <input type='text' value='".$prestamo['DURACION']."' size='1em' class='sinborde' readonly>
                                <span> - CUOTAS $</span>
                                <input type='number' value='".$prestamo['CUOTAS']."' class='sinborde' readonly>
                                
                            </p>
                            <p class='subrayado vertical-aliniacion-center'>Nombre
                                <input type='text' value='".$prestamo['NOMBRE']."' class='sinborde' readonly>
                                <span> &nbsp &nbsp DNI: </span>
                                <input type='text' value='".$prestamo['DNI']."' size='4em' class='sinborde' readonly>
                            </p>
                            <p class='comprobante__datos__left'>
                                <label for='money'> Son $ &nbsp</label>
                                <input type='text' value='$".$prestamo['MONTONUM']."' id='money' class='ralla' size='5em'disabled>
                            </p>
                            <p class='comprobante__datos__right subrayado'></p>
                 </article> 
                </section>";
                echo "<a href='imprimir.php?numero=".$prestamo['ID']."'><input type='button' value='imprimir'></a>";

            }
            else{

            }
            }
        ?>
       </section>  
</body>
</html>