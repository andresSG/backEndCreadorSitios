<?php
session_start();
if ($_SESSION["logueado"] == TRUE) {
	require './connectionSQLite.php';
	$conn = new connectionSQLite('..');

	if (isset($_POST['editTexts'])) {
		//editar Texto EN CONSTRTUCCION
		Header("Location: ../editText.php");
	}

	if (isset($_POST['delTexts'])) {
		//borrar texto
		if ($conn->delString($_POST['id1'])) {
			Header("Location: ../textos.php?d=1");
		} else {
			Header("Location: ../textos.php?d=2");
		}

	}

} else {
	Header("Location: ../index.php");
}
?>