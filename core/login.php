<?php

if (isset($_POST["submit"])) {

	require './connectionSQLite.php';

	$conn = new connectionSQLite('..');

	$loginNombre = $_POST["user01"];
	$loginPassword = md5($_POST["pass01"]);

	//$conn->checkPassword($loginNombre, $loginPassword);
	if (isset($loginNombre) && isset($loginPassword)) {

		if ($conn->checkPassword($loginNombre, $loginPassword)) {
			session_start();

			$_SESSION["logueado"] = TRUE;

			header("Location: ../admin.php");
		} else {
			Header("Location: ../index.php?error=login");
		}

	}

} else {
	header("Location: ../index.php");
}
?>