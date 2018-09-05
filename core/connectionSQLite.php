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
		$querya->bindValue(':pass', md5($pass));

		$querya->execute();

		$row = $querya->fetch();

		if (is_null($row[1]) or empty($row[1]) or !isset($row[1])) {
			return false;
		} elseif (isset($row[1]) and !is_null($row[1])) {
			return true;
		}
		return false;
	}

	function getUsers() {
		$querya = $this->getConn()->prepare('SELECT id, full_name FROM users ;');

		$querya->execute();

		$row = $querya->fetchAll(PDO::FETCH_ASSOC);
		if (is_null($row) or empty($row) or !isset($row)) {
			return false;
		} elseif (isset($row) and !is_null($row)) {
			return $row;
		}
		return false;
	}

	function getUser($user) {
		$querya = $this->getConn()->prepare('SELECT id, full_name, password, role FROM users where full_name = :name;');

		$querya->execute([':name' => $user]);

		$row = $querya->fetch();

		if (is_null($row[1]) or empty($row[1]) or !isset($row[1])) {
			return false;
		} elseif (isset($row[1]) and !is_null($row[1])) {
			return $row;
		}
		return false;
	}

	function getStrings() {
		$querya = $this->getConn()->prepare('SELECT id, full_name, password, role FROM users where full_name = :name;');

		$querya->execute([':name' => $user]);

		$row = $querya->fetch();

		if (is_null($row[1]) or empty($row[1]) or !isset($row[1])) {
			return false;
		} elseif (isset($row[1]) and !is_null($row[1])) {
			return $row;
		}
		return false;
	}

	function isAdmin($user) {
		$data = $this->getUser($user);

		if ($data["role"] == 1) {
			return true;
		} else {
			return false;
		}
		return false;
	}

	function addUser($user, $pass) {
		$querya = $this->getConn()->prepare('insert into users (full_name, password) values (:user, :pass);');

		$querya->bindValue(':user', $user);
		$querya->bindValue(':pass', md5($pass));

		return $querya->execute();
	}

	function editPsw($user, $newPass) {
		//usuario y nueva pass
		$passwMD5 = md5($newPass);

		$queryb = $this->getConn()->prepare('update users set password = :passMD5 where full_name = :user;');

		$queryb->bindValue(':passMD5', $passwMD5);
		$queryb->bindValue(':user', $user);

		return $queryb->execute();
	}

	function removeUser($user) {
		$querya = $this->getConn()->prepare('delete from users where id = :id ;');

		$querya->bindValue(':id', $user);

		return $querya->execute();
	}

}
?>
