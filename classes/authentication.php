<?php
ob_start();
session_start();

/**
 * Base class that provides simple user authentication
 *
 * @author RadoRado (a.k.a Rado)
 */
class Authentication extends DatabaseAware {

	public $tokenAlphabet = "abcdefghijklmnopqrstuvw0123456789!@#$%^&*()";
	public $tokenLength = 32;
	private $salt = "%*4!#;\.k~'(_@";
	// should be random
	private $timeOut = 7200;
	// 2 hours

	public function setSalt($salt) {
		$this -> salt = $salt;
	}

	public function login($adminId, $password) {
		$password = $this -> encrypt($password);

		$sql = "SELECT COUNT(admin_id) as OK
                FROM administrative
                WHERE admin_id = ? AND password_hash = ?
                LIMIT 1";

		$res = $this -> database -> query($sql, array((int)$adminId, $password));
		$row = $res -> fetch();
		if ($row -> OK == 1) {
			unset($_SESSION["adminId"]);
			session_regenerate_id();
			$_SESSION["adminId"] = $adminId;
			$this -> updateLoginTime($adminId);
			$token = $this -> getRandomToken($adminId);
			$this -> updateLoginToken($adminId, $token);
			return $token;
		}

		return FALSE;
	}

	public function checkLogin() {
		if (!isset($_SESSION["adminId"]) || !isset($_SESSION["token"]) || (int)$_SESSION["adminId"] <= 0) {
			return FALSE;
		}
		$id = $_SESSION["adminId"];
		$token = $_SESSION["token"];

		return $this -> checkToken($id, $token) && $this -> checkSessionTimeout($id);
	}

	public function getLastLoginTime($adminId) {
		$sql = "SELECT last_login
                FROM administrative
                WHERE admin_id = ?
                LIMIT 1";
		$res = $database -> query($sql, array((int)$adminId));
		$row = $res -> fetch();
		return $row -> last_login;
	}

	public function logout() {
		unset($_SESSION["adminId"]);
		unset($_SESSION["token"]);
		session_destroy();
	}

	public function create($password) {
		$password = $this -> encrypt($password);
		$sql = "INSERT INTO administrative(password_hash)
                VALUES(?)";
		$this -> database -> exec($sql, array($password));
		return $this -> database -> lastInsertId();

	}

	public function encrypt($string) {
		// some random salt method from php.net
		$salt = md5($string . $this -> salt);
		$string = md5("$salt$string$salt");
		return $string;
	}

	private function getRandomToken($studentId) {
		$t = new Token($this -> tokenAlphabet, $this -> tokenLength);
		// check for existing tokens
		while ($this -> checkToken($studentId, $t -> getString())) {
			$t = Token($this -> tokenAlphabet, $this -> tokenLength);
		}
		return $t -> getString();
	}

	private function checkToken($adminId, $token) {
		$sql = "SELECT COUNT(admin_id) AS OK
                FROM administrative
                WHERE admin_id = ? AND token = ?
                LIMIT 1";
		$res = $this -> database -> query($sql, array((int)$adminId, $token));
		$row = $res -> fetch();
		return ($row -> OK == 1);
	}

	private function checkSessionTimeout($adminId) {
		$sql = "SELECT UNIX_TIMESTAMP(last_login) AS time FROM administrative WHERE admin_id = ? LIMIT 1";
		$res = $this -> database -> query($sql, array((int)$adminId));
		$row = $res -> fetch();
		return ((time() - $row -> time) < $this -> timeOut);

	}

	private function updateLoginTime($adminId) {
		$sql = "UPDATE administrative
                SET last_login = FROM_UNIXTIME(?)
                WHERE admin_id = ?
                LIMIT 1";
		$this -> database -> exec($sql, array(time(), (int)$adminId));
	}

	private function updateLoginToken($adminId, $token) {
		$sql = "UPDATE administrative
                SET token = ?
                WHERE admin_id = ?
                LIMIT 1";
		$this -> database -> query($sql, array($token, (int)$adminId));
		$_SESSION["token"] = $token;
	}

}
