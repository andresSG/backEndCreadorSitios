<!DOCTYPE html>
<?php
session_start();
require 'core/connectionSQLite.php';
$conn = new connectionSQLite('.');

if (isset($_SESSION['nightMode'])) {
	echo '<script> var night= "' . $_SESSION['nightMode'] . '"; </script>';
} else {
	echo '<script> var night;</script>';
}

if (isset($_SESSION["ident"]) && isset($_SESSION["clave"])) {
	$clave = $_SESSION["clave"];
	$identificador = $_SESSION["ident"];

	unset($_SESSION["clave"]);
	unset($_SESSION["ident"]);
}
//obtenemos un valor según los parametros recogidos
if (isset($identificador)) {
	$textos = $conn->getString($identificador);
} else {
	header("Location: ./textos.php");
	echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/textos.php' </script>";
}

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
			document.write("<th> Key </th><th> Spa </th><th> Eng </th><th> Action </th>");
			document.write("</thead>");
			for (var i = 0; i < (arr.length); i++) {
				document.write("<tr>");
				document.write("<td class='clave'> "+arr[i]["key"]+"</td>"+
					"<td> "+arr[i]["ES"]+" </td>"+
					"<td> "+arr[i]["EN"]+"</td>"+
					"<td> <form action='./core/texts.php' method='POST' id='edit' accept-charset='utf-8'> "+
					"<input type='hidden' value='"+arr[i]["id"]+"' name='id1'>"+
					"<input type='hidden' value='"+arr[i]["key"]+"' name='key1'>"+
					"</td></tr>");
				document.write("<tr><td> new values -> </td>"+
					"<td><textarea rows='4' cols='30' name='newES' form='edit'>"+ arr[i]["ES"] +"</textarea></td>"+
					"<td><textarea rows='4' cols='30' name='newEN' form='edit'>"+ arr[i]["EN"] +"</textarea></td>"+
					"<td><input type='submit' value='Guardar' name='modText'></td></form></tr>");
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
	echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php' </script>";
}

?>
</html>
