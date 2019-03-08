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
        <section class="bordes-bot tam contenido clientes">     
            <article class="clientes__nuevo">
                <form action="" method="POST">
                    <fieldset>
                        <legend> Nuevo Cliente</legend>
                        <div>
                            <input type="image" src="images/add_c.svg" name="nuevo" class="tam_img_boton">    
                        </div>
                        <div>
                            <input type="text" name="nuevoNombre" id="nombreAgr" autocomplete="off" required placeholder="NOMBRE" class="clientes_text">
                            <input type="text" name="nuevoDni" id="dniAgr" autocomplete="off"required placeholder="DNI" class="clientes_text">
                            <input type="date" name="nuevoFechaNac" id="nombreAgr" autocomplete="off" required placeholder="Fecha de nacimiento" class="clientes_text">
                            <br>
                            <input type="text" name="nuevoDireccion" id="dniAgr" autocomplete="off"required placeholder="direccion" class="clientes_text">

                            <input type="number" name="nuevoTel" id="nombreAgr" autocomplete="off" required placeholder="telefono" class="clientes_text">
                        </div>
                   
                    </fieldset>
                    
                </form>
                <?php
                    if (isset($_POST['nuevoNombre'])) {
                        $resultado=$consultas->nuevoCliente($_POST['nuevoNombre'],$_POST['nuevoDni'],$_POST['nuevoFechaNac'],$_POST['nuevoDireccion'],$_POST['nuevoTel'], $conexion);
                        if ($resultado==1){
                            echo "<p> Cliente agregado satifactoriamente</p>";
                        }
                        elseif($resultado==-1){
                            echo "<p> El cliente ya existe!!!</p>";
                        }
                        else{
                            echo "<p> Fallo en agregar el cliente intentelo de nuevo</p>";
                        }
                    }
                ?>
            </article>
            <article class="clientes__lista">
                <fieldset>
                    <legend> LISTA</legend>
                <form action="" method="POST">
                    <input type="search" name="nombreBus" placeholder="NOMBRE" autocomplete="off" class="clientes_text">
                    <input type="image" src="images/search_c.svg" name="buscar" value="BUSCAR" class="tam_img_boton" alt="Submit">
                </form>
                <?php

                        if (isset($_POST['nombreBus']))
                        {
                            $nombreBus="%{$_POST['nombreBus']}%";
                            if (empty($nombreBus)){
                               $nombreBus='%_%';
                            }
                            $encontrados=$consultas->buscarClientes($nombreBus,$conexion);
                            if ($encontrados!=false)
                            {
                                $encontrados->bind_result($id,$nombre,$dni,$fecha,$dir,$tel);
                                echo "<table>
                                        <tr>
                                            <th>Nombre</th>
                                            <th> Dni</th>
                                            <th> Fecha Nacimiento</th>
                                            <th class='clientes__lista__Dir'> Direccion</th>
                                            <th> Telefono</th>
                                            <th> Modificar</th>
                                            <th> Borrar</th>
                                        </tr>";
                                while ($encontrados->fetch()) {
                                    echo '<tr>';
                                        echo '<td>' . $nombre. '</td>';
                                        echo '<td>' . $dni . '</td>';
                                        echo '<td>' . $fecha . '</td>';
                                        echo "<td class='clientes__lista__Dir'>" . $dir . "</td>";
                                        echo '<td>' . $tel . '</td>';
                                    ?>
                                    <td> <a href="#" onclick="abrirVentana(<?php echo "'modcliente.php?cliente=".$id."&accion=a'"?>)">  <img src="images/edit_c.svg"></a>
                                    </td>
                                    <td> <a href="#" onclick="abrirVentana(<?php echo "'modcliente.php?cliente=".$id."&accion=e'" ?>)"> 
                                        <img src='images/remove_c.svg'></a>
                                    </td>
                                    </tr>
                                <?php
                                }
                                echo '</table>';
                                $encontrados->close();
                            }
                            else
                            {
                                echo "<p class='clientes__P'>No se encontraron clientes</p>";
                            }         
                        }
                    ?>
                </fieldset>
            </article>
        </section>     
    <script>
             function abrirVentana(url) {
                window.open(url,"modificar","width=300, height=300,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0");
            }
     </script>
    </body>
</html>