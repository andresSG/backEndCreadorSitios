<!DOCTYPE html>
<?php
session_start();

if ($_SESSION["logueado"] == TRUE) {
	?>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximun-scale=1">
		<link rel="stylesheet" href="./css/style.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
		<script type="text/javascript" src="./js/funciones-basic.js"></script>

		<title>Panel Administración</title>
	</head>
	<body id="bd">
		<div class="central">
			<h2>Administración website</h2>
			<a href="#" title="Edit Text"> <i class="fas fa-edit fa-2x"> Editar Textos</i></a> <br><br>
			<a href="#" title="Edit Img"> <i class="fas fa-images fa-2x"> Editar Imagenes</i></a> <br><br>
			<a href="#" title="Edit Users Adm"> <i class="fas fa-user-shield fa-2x"> Editar User Admin</i></a>
		</div>
	</body>
	<div class="footer">
		<div>
  			<a class="by" href="https://github.com/andresSG/" title="AndresSG github"> &nbsp AndresSG &nbsp <i class="fab fa-github-square fa-lg"></i></a>
  		</div>
  		<div class="mode-n">
	        <i class="fas fa-sun"></i>
	       		&nbsp;&nbsp;
	        <input type="checkbox" id="tooglenight" class="cbx hidden"/>
	        <label for="tooglenight" class="switch"></label>
	        	&nbsp;&nbsp;
        	<i class="fas fa-moon"></i>
    	</div>

    	<div class="exit">
        	<a href="salir.php" title="Exit"><i class="fas fa-door-open"> &nbsp Exit</i></a>
    	</div>

	</div>

	<?php

} else {
	header("Location: .\index.html");
}

?>
</html>
