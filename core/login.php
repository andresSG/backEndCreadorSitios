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
		} else {
			Header("Location: ../index.php?error=login");
		}

	} else {
		header("Location: ../index.php");
	}

} else {
	header("Location: ../index.php");
}
?>