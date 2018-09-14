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
		$querya = $this->getConn()->prepare(
			'SELECT ES.id, ES.key, case when (length(ES.value) >= 51) then (substr(ES.value, 1, 50) || "...") else ES.value end as "ES", case when (length(EN.value) >= 51) then (substr(EN.value, 1, 50) || "...") else EN.value end as "EN" from ES, EN where ES.id = EN.id order by ES.id;');

		$querya->execute();
		$row = $querya->fetchAll(PDO::FETCH_ASSOC);

		if (is_null($row) or empty($row) or !isset($row)) {
			return false;
		} elseif (isset($row) and !is_null($row)) {
			return $row;
		}
		return false;
	}

	function getString($id) {
		$querya = $this->getConn()->prepare('SELECT ES.id, ES.key, ES.value "ES", EN.value "EN" from ES, EN where ES.id = EN.id and ES.id = :id;');

		$querya->bindValue(':id', $id);
		$querya->execute();
		$row = $querya->fetchAll();

		if (is_null($row[1]) or empty($row[1]) or !isset($row[1])) {
			return false;
		} elseif (isset($row[1]) and !is_null($row[1])) {
			return $row;
		}
		return false;
	}

	function insertString($key, $spanish, $english) {
		//cambiar a query transact
		$querya = $this->getConn()->prepare('insert into ES (key, value) values (:key, :spanish);');
		$queryb = $this->getConn()->prepare('insert into EN (key, value) values (:key, :spanish);');

		$querya->bindValue(':key', $key);
		$querya->bindValue(':spanish', $spanish);
		$queryb->bindValue(':key', $key);
		$queryb->bindValue(':english', $english);

		if (!existString($key)) {
			//si no existe una key similar la agrega, para evitar generar keys duplicadas
			$executeES = $querya->execute();
			$executeEN = $queryb->execute();
		} else {
			return false;
		}

		if ($executeES and $executeEN) {
			return true;
		} else {
			return false;
		}
		return false;
	}

	function delString($id) {
		$querya = $this->getConn()->prepare('delete from ES where id = :id;');
		$queryb = $this->getConn()->prepare('delete from EN where id = :id2;');

		$querya->bindValue(':id', $id);
		$queryb->bindValue(':id2', $id);

		$executeES = $querya->execute();
		$executeEN = $queryb->execute();

		if ($executeES and $executeEN) {
			return true;
		} else {
			return false;
		}
		return false;
	}

	function existString($key) {
		$querya = $this->getConn()->prepare('SELECT ES.id, ES.key, ES.value "ES", EN.value "EN" from ES, EN where  ES.key = EN.key and ES.key = :key;');

		$querya->bindValue(':key', $key);
		$row = $querya->execute();

		if (is_null($row[1]) or empty($row[1]) or !isset($row[1])) {
			return false;
		} elseif (isset($row[1]) and !is_null($row[1])) {
			return $row;
		}
		return false;
	}

	function isAdmin($user) {
		$data = $this->getUser($user);

		return $data["role"] == 1;
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
