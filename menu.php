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


         ?>
    </head>
    <body class="fondo">
        <?php 
            include ("modulo_encabezado.php");
         ?>
         <section class="bordes-bot tam contenido">
             
             <?php
                echo "<h1> Bienvenido " . $_SESSION['usuario'] . "</h1>";
              ?> 
         </section>
         
    </body>
</html>