<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>prestamo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">
    
</head>
<body class="fondo">
<header class="bordes-top tam titulo">
		<h1> PRESTAMOS J&L</h1>
	</header>
	<nav class="tam navegacion">
		<ul>
			<li><a href="/prestamo/create">Nuevo</a></li>
			<li><a href="comprobante.php">Imprimir</a></li>
			<li><a href="clientes.php">Clientes</a></li>
			<li><a href="prestamos.php">Prestamos</a>
			<li><a href="salir.php">Salir</a></li>
		</ul>
	</nav>

<div class="bordes-bot tam contenido" id="app">
@yield('contenido')
</div>
@yield('script')


</body>
</html>