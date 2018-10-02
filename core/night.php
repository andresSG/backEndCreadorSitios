<?php
session_start();
if (isset($_POST['nightMode'])) {
	//yes or no
	$_SESSION['nightMode'] = $_POST['nightMode'];
	echo "night mode: " . $_SESSION['nightMode'];
} else {
	header("Location: ../index.php");
	echo "<script> location.pathname = '/'+location.pathname.split('/')[1]+'/index.php' </script>";
}

?>