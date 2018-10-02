<?php
session_start();
if ($_SESSION["logueado"] == TRUE) {
	require './connectionSQLite.php';
	$conn = new connectionSQLite('..');
	$no_mod = false;
	$no_edit = false;
	$no_del = false;

	//id a editar
	if (isset($_POST['editTexts'])) {
		//editar Texto
		$_SESSION["clave"] = $_POST['key1'];
		$_SESSION["ident"] = $_POST['id1'];
		Header("Location: ../editText.php");
		echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/editText.php'</script>";
	} else {
		$no_edit = true;
	}

	//borrar
	if (isset($_POST['delTexts'])) {
		//borrar texto
		if ($conn->delString($_POST['id1'])) {
			//success
			Header("Location: ../textos.php?d=1");
			echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/textos.php?d=1'</script>";
		} else {
			//fail
			Header("Location: ../textos.php?d=2");
			echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/textos.php?d=2'</script>";
		}
	} else {
		$no_del = true;
	}

	//modificar
	if (isset($_POST['modText'])) {
		if ($conn->updateString($_POST['id1'], $_POST['newES'], $_POST['newEN'])) {
			Header("Location: ../textos.php?d=1");
			echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/textos.php?d=1'</script>";
		} else {
			Header("Location: ../textos.php?d=2");
			echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/textos.php?d=2'</script>";
		}
	} else {
		$no_mod = true;
	}

	//si se hace una llamada no controlada por los formularios
	if ($no_del && $no_edit && $no_mod) {
		header("Location: ../index.php");
		echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php'</script>";
	}

} else {
	Header("Location: ../index.php");
	echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php'</script>";
}
?>