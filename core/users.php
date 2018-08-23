<?php
session_start();
if ($_SESSION["logueado"] == TRUE) {
	require './connectionSQLite.php';

	$conn = new connectionSQLite('..');

	if (isset($_POST['edit-sn'])) {
		$edit = $_POST['edit-sn'];
		//construction
	}

	if (isset($_POST['delete-sn'])) {
		$del = $_POST['edit-sn'];

		if ($conn->removeUser($del)) {
			header("Location: ../usuarios.php?d=0");
		} else {
			Header("Location: ../usuarios.php?d=1");
		}

	}

} else {
	Header("Location: ../index.php");
}
?>