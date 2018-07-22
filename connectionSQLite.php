<?php
class connectionSQLite {
	private $conn;

	function __construct($path) {

		$dbh = "";
		try {
			/*** connect to SQLite database ***/
			if ($path == "" or is_null($path)) {
				$path = ".";
			}
			$dbh = new PDO("sqlite:" . $path . "/db.sql");

		} catch (PDOException $e) {
			echo $e->getMessage();
			echo "<br><br>Database -- NOT -- loaded successfully ";
			die("<br>Query Closed !!! $error");
		}
		$conn = $dbh;
	}

	function getConn() {
		return $conn;
	}

}
?>