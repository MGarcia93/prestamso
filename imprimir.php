<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Prestamos</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        

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
            $datos=$consultas->prestamosBuscar($conexion,$_GET['numero']);
            $prestamo=$datos->fetch_assoc();
            $fecha=$prestamo['FECHA'];
            $dia=$fecha[8].$fecha[9];
            $mesanio=$fecha[0].$fecha[1].$fecha[2].$fecha[3].$fecha[4].$fecha[5].$fecha[6];

        ?>
        <div class="pagina1">
                <h1 class="titulo"> PRESTAMO</h1>
                <section class=comprobante>
                   
                        <article class="comprobante__concepto comprobate__position">
                            <h3>Concepto</h3>
                            <h3>PRESTAMO</h3>
                            <h3> 
                                <input type="text" name="montoc" size="4em" class="subrayado2" value=<?php echo "'$ ".$prestamo['MONTONUM']."'";?> readonly>
                            </h3>
                        </article>   
                        <article class="comprobante__img comprobate__position">
                           <img src=sello.jpg >
                        </article> 
                        <article class="comprobante__datos comprobate__position">
                            <p class="comprobate__position">
                                N°: <input type="text" name="numero" class=ralla size="1em" value="<?php echo $prestamo['ID'].'  ';?>" readonly>
                                &nbsp
                                &nbsp
                                <span class="right">
                                <input type="numero" name="dia" max="31"  size="1em" class="subrayado" value="<?php echo $dia;?>" readonly>
                                &nbsp de &nbsp
                                <input type="month" name="mesAño" class="subrayado" value="<?php echo $mesanio;?>" readonly>
                                </span> 
                            </p>
                            <p>
                                RECIBI &nbsp &nbsp<strong> $ </strong> &nbsp &nbsp  de  &nbsp  
                                <input type="text" name="prestador" size= "30em" class=subrayado value="<?php echo $prestamo['PRESTADOR'];?>" readonly>
                            </p>
                            <p>
                                la cantidad de pesos &nbsp
                                <input type="text" name="plata" class="ralla" size=30% value="<?php echo '$'.$prestamo['MONTONUM'] .' (' . $prestamo['MONTOLETRA'].')';?>" readonly>    
                                
                            </p>
                            <p class=ralla>
                                En concepto de préstamo a paga del 1 al 10 de cada mes.
                            </p>
                            <p class=subrayado>
                                DURANTE
                                <input type="tex" name="duracion" size="1em" class="sinborde" value="<?php echo $prestamo['DURACION'];?>" readonly>
                                <span> - CUOTAS $</span>
                                <input type="num" name="montocuota" size="3em" class="sinborde" value="<?php echo $prestamo['CUOTAS'];?>" readonly>
                                
                            </p>
                            <p class="subrayado vertical-aliniacion-center">
                                <input type="text" name="nombre" class="sinborde" value="<?php echo $prestamo['NOMBRE'];?>" readonly>
                                <span> &nbsp &nbsp DNI: </span>
                                <input type="text" class="sinborde" value="<?php echo $prestamo['DNI'];?>" readonly>
                            </p>
                            <p >
                                <span class="comprobante__datos__left subrayado" >
                                    <label for="money" > Son $ &nbsp</label>
                                    <input type="text" value="<?php echo $prestamo['MONTONUM'];?>" readonly class="ralla" size="5em">
                                </span>
                                <span class="comprobante__datos__right" ><input type="text" size="10em" readonly class="subrayado"></span>
                                
                            </p>
                        </article> 
                </section>
                <p class="comprobante__sepracion"></p>
                <section class=comprobante>
                   
                        <article class="comprobante__concepto comprobate__position">
                            <h3>Concepto</h3>
                            <h3>PRESTAMO</h3>
                            <h3> 
                                <input type="text" name="montoc" size="4em" class="subrayado2" value=<?php echo "'$ ".$prestamo['MONTONUM']."'";?> readonly>
                            </h3>
                        </article>   
                        <article class="comprobante__img comprobate__position">
                           <img src=sello.jpg >
                        </article> 
                        <article class="comprobante__datos comprobate__position">
                            <p class="comprobate__position">
                                N°: <input type="text" name="numero" class=ralla size="1em" value="<?php echo $prestamo['ID'].'  ';?>" readonly>
                                &nbsp
                                &nbsp
                                <span class="right">
                                <input type="numero" name="dia" max="31"  size="1em" class="subrayado" value="<?php echo $dia;?>" readonly>
                                &nbsp de &nbsp
                                <input type="month" name="mesAño" class="subrayado" value="<?php echo $mesanio;?>" readonly>
                                </span> 
                            </p>
                            <p>
                                RECIBI &nbsp &nbsp<strong> $ </strong> &nbsp &nbsp  de  &nbsp  
                                <input type="text" name="prestador" size= "30em" class=subrayado value="<?php echo $prestamo['PRESTADOR'];?>" readonly>
                            </p>
                            <p>
                                la cantidad de pesos &nbsp
                                <input type="text" name="plata" class="ralla" size=30% value="<?php echo '$'.$prestamo['MONTONUM'] .' (' . $prestamo['MONTOLETRA'].')';?>" readonly>    
                                
                            </p>
                            <p class=ralla>
                                En concepto de préstamo a paga del 1 al 10 de cada mes.
                            </p>
                            <p class=subrayado>
                                DURANTE
                                <input type="tex" name="duracion" size="1em" class="sinborde" value="<?php echo $prestamo['DURACION'];?>" readonly>
                                <span> - CUOTAS $</span>
                                <input type="num" name="montocuota" size="3em" class="sinborde" value="<?php echo $prestamo['CUOTAS'];?>" readonly>
                                
                            </p>
                            <p class="subrayado vertical-aliniacion-center">
                                <input type="text" name="nombre" class="sinborde" value="<?php echo $prestamo['NOMBRE'];?>" readonly>
                                <span> &nbsp &nbsp DNI: </span>
                                <input type="text" class="sinborde" value="<?php echo $prestamo['DNI'];?>" readonly>
                            </p>
                            <p >
                                <span class="comprobante__datos__left subrayado" >
                                    <label for="money" > Son $ &nbsp</label>
                                    <input type="text" value="<?php echo $prestamo['MONTONUM'];?>" readonly class="ralla" size="5em">
                                </span>
                                <span class="comprobante__datos__right" ><input type="text" size="10em" readonly class="subrayado"></span>
                                
                            </p>
                        </article> 
                </section>
        </div>
        <div class="comprobante__pagina2">
            <section>
                <article>
                    <p>Los pagos se realizaran mediante depósito bancarios a la cuenta de Lucia Macarena Rodriguez DNI 36988324 cuenta número 355274/4 con numero de CBU 0720517088000035527440 sucursal 0517 Santander Rio</p>
                    <p>Por cualquier consulta o duda llamar al celular 1124707439 del Sr. Jonatan Aguirre</p>
                    <p class="comprobante__letraChica">Se cobrara entre los días 1 al 10 de cada mes pasado la fecha se le cobrara por día un monto del  2  por ciento de la cuota mensual  </p>

                </article>
            </section>
            <p class="comprobante__sepracion"></p>
            <section>
                <article>
                    <p>Los pagos se realizaran mediante depósito bancarios a la cuenta de Lucia Macarena Rodriguez DNI 36988324 cuenta número 355274/4 con numero de CBU 0720517088000035527440 sucursal 0517 Santander Rio</p>
                    <p>Por cualquier consulta o duda llamar al celular 1124707439 del Sr. Jonatan Aguirre</p>
                    <p class="comprobante__letraChica">Se cobrara entre los días 1 al 10 de cada mes pasado la fecha se le cobrara por día un monto del  2  por ciento de la cuota mensual  </p>
                </article>
            </section>
        </div>    
    </body>
</html>