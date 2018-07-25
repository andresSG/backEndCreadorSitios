<?php
class connectionSQLite {
	private $conn;

	function __construct($path) {

		$dbh = "";
		try {
			/*** connect to SQLite database ***/
			if ($path == "" or is_null($path) or empty($path)) {
				$path = ".";
			}
			$dbh = new PDO("sqlite:" . $path . "/db.sql");

		} catch (PDOException $e) {
			echo $e->getMessage();
			echo "<br><br>Database -- NOT -- loaded successfully ";
			die("<br>Query Closed !!! $error");
		}
		$this->conn = $dbh;
	}

	function getConn() {
		return $this->conn;
	}

	function checkPassword($user, $pass) {
		$querya = $this->getConn()->prepare('SELECT * FROM users WHERE full_name = :id and password = :pass;');
		$querya->bindValue(':id', $user);
		$querya->bindValue(':pass', $pass);

		$querya->execute();

		$row = $querya->fetch();

		if (is_null($row[1]) or empty($row[1]) or !isset($row[1])) {
			return false;
		} elseif (isset($row[1]) and !is_null($row[1])) {
			return true;
		}
		return false;
	}

}
?>
