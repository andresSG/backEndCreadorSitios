<?php

if (isset($_POST["submit"])) {

	require './connectionSQLite.php';

	$conn = new connectionSQLite('..');

	$loginNombre = $_POST["user01"];
	$loginPassword = $_POST["pass01"];

	//$conn->checkPassword($loginNombre, $loginPassword);
	if (isset($loginNombre) && isset($loginPassword)) {

		if ($conn->checkPassword($loginNombre, $loginPassword)) {
			session_start();

			$_SESSION["logueado"] = TRUE;
			$_SESSION["usuario_log"] = $loginNombre; //quien se ha logueado

			header("Location: ../admin.php");
			echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php'</script>";
		} else {
			Header("Location: ../index.php?error=login");
			echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php?error=login'</script>";
		}

	} else {
		header("Location: ../index.php");
		echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php'</script>";
	}

} else {
	header("Location: ../index.php");
	echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php'</script>";
}
?>