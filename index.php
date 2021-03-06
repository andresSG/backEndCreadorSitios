<!DOCTYPE html>
<html lang="es">
<?php
session_start();

if (isset($_SESSION['nightMode'])) {
	echo '<script> var night= "' . $_SESSION['nightMode'] . '"; </script>';
} else {
	echo '<script> var night;</script>';
}

if (!empty($_SESSION["logueado"])) {
	if ($_SESSION["logueado"] == TRUE) {
		Header("Location: admin.php");
		echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/admin.php' </script>";
	}
}

?>
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
			<form action="core/login.php" method="post">
				<h2>Formulario de acceso</h2>
				<input type="text" name="user01" placeholder="&#9919;  Usuario">
				<input type="password" name="pass01" placeholder="&#9919;  Password">
				<input type="submit" name="submit" value="Login">
				<?php
if (isset($_GET["error"])) {
	if ($_GET["error"] == 'login') {
		echo "<br><p class='error'><i class='fas fa-exclamation-circle'></i> &nbsp Usuario y / o Contraseña erroneos. Intentelo de nuevo.</p>";
	}
}
?>
			</form>
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

	</div>
</html>
