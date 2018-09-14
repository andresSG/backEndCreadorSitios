<!DOCTYPE html>
<?php
session_start();
require 'core/connectionSQLite.php';
$conn = new connectionSQLite('.');
$textos = $conn->getStrings();

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
			<h2>Editar Texto</h2>
			<script type='text/javascript'>
			var arr = <?php echo json_encode($textos); ?>;
			document.write("<table class='texts'>");
			document.write("<thead>");
			document.write("<th> Key </th><th> Spa </th><th> Ing </th><th> Action </th>");
			document.write("</thead>");
			for (var i = 0; i < (arr.length); i++) {
				document.write("<tr>");
				document.write("<td> "+arr[i]["key"]+"</td>"+
					"<td> "+arr[i]["ES"]+" </td>"+
					"<td> "+arr[i]["EN"]+"</td>"+
					"<td> Button </td>");
				document.write("</tr>");
			}
			document.write("</table>");
			</script>
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
        	<a href="core/salir.php" title="Exit"><i class="fas fa-door-open"> Exit</i></a>
    	</div>

	</div>

	<?php

} else {
	header("Location: .\index.php");
}

?>
</html>
