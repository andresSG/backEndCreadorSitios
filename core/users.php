<?php
session_start();
if ($_SESSION["logueado"] == TRUE) {
	require './connectionSQLite.php';

	$conn = new connectionSQLite('..');

	if (isset($_POST['edit-sn'])) {
//editar
		$edit = $_POST['edit-sn'];

		if (isset($_POST['lastPW']) && isset($_POST['newPW'])) {
			if ($conn->checkPassword($edit, $_POST['lastPW'])) {
				accionBack($conn->editPsw($edit, $_POST['newPW']));
			} else {
				accionBack(3);
			}
		} else {
			accionBack(2);
		}
	}

	if (isset($_POST['delete-sn'])) {
		//delete user
		$idDel = $_POST['delete-sn'];

		accionBack($conn->removeUser($idDel));
	}

} else {
	Header("Location: ../index.php");
}

function accionBack($valor) {

	switch ($valor) {
	case 1:
		header("Location: ../usuarios.php?d=1"); //accion completada
		break;

	case 2:
		header("Location: ../usuarios.php?d=2"); //no se han recibido datos de las passw
		break;

	case 3:
		header("Location: ../usuarios.php?d=3"); //las passw no coinciden
		break;

	default:
		Header("Location: ../usuarios.php?d=0"); //se han producido errores
		break;
	}
}
?>