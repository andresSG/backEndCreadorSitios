<!DOCTYPE html>
<?php
session_start();
require 'core/connectionSQLite.php';
$conn = new connectionSQLite('.');

$usuarios = $conn->getUsers();

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

		<title>Cuentas usuarios</title>
	</head>
	<body id="bd">
		<div class="central">
			<h2>Usuarios</h2>
			<script type='text/javascript'>

			var arr = <?php echo json_encode($usuarios); ?>;

			document.write("<div class='usuarios'>");
			for (var i = 0; i < (arr.length); i++) {
				document.write("<div class='user' id='u_"+arr[i]["id"]+"' >");
				document.write("<name_u> " + arr[i]["full_name"] +"</name_u>");
				document.write("<form action='./core/users.php' method='POST' accept-charset='utf-8'>");
				document.write("<input type='hidden' value='"+arr[i]["id"]+"' name='edit'>");
				document.write("<button id='btEditar' name='btEditar' class='btn btEditar'><i class='fas fa-angle-down fa-3x'></i> Editar </button>");
				document.write("<div class='divedit'>");
				document.write("<input type='Password' class='ocult' name='lastPW' id='lastPW' placeholder='Last Password' required>");
				document.write("<input type='Password' class='ocult' name='newPW' id='newPW' placeholder='New Password' required>");
				document.write("<button id='"+arr[i]["id"]+"' type='submit' value='"+arr[i]["full_name"]+"' name='edit-sn' class='btn btn-success ocult'><i id='"+arr[i]["id"]+"' name='"+arr[i]["full_name"]+"' class='fas fa-user-edit fa-2x'></i> Guardar Cambios </button>");
				document.write("</div>");
				document.write("</form>");

				document.write("<form action='./core/users.php' method='POST' accept-charset='utf-8'>");
				document.write("<input type='hidden' value='"+arr[i]["id"]+"' name='delete'>");
				document.write("<button id='"+arr[i]["id"]+"' type='submit' name='delete-sn' class='btn btn-success' value='"+arr[i]["id"]+"'><i id='"+arr[i]["id"]+"' class='fas fa-user-times fa-2x'></i> Borrar </button>");
				document.write("</form>");
				document.write("</div>");
				document.write("<hr>");
			}
			document.write("</div>");
			</script>

			<?php
if (isset($_GET["d"])) {
		switch ($_GET["d"]) {
		case 1:
			echo "<br><p class='info'><i class='far fa-thumbs-up'></i> &nbsp Se completo acción</p>";
			break;

		case 2:
			echo "<br><p class='error'><i class='fas fa-exclamation-circle'></i> &nbsp Completa los campos de las contraseñas</p>";
			break;

		case 3:
			echo "<br><p class='error'><i class='fas fa-exclamation-circle'></i> &nbsp Las contraseñas no coinciden, prueba otra vez.</p>";
			break;

		default:
			echo "<br><p class='error'><i class='fas fa-exclamation-circle'></i> &nbsp No se pudo completar la acción seleccionada.</p>";
			break;
		}
	}
	?>

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
