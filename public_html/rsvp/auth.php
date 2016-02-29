<?php

session_start();

require_once "database.php";
require_once "password_hash.php";

class Auth {
	private $db;
	private $isLoggedIn;
	private $regionID;

	function __construct(Database $db) {
		$this->db = $db;
		$this->isLoggedIn = false;
		$this->regionID = -1;
	}

	function restore_session() {
		if (isset($_SESSION["sessionUser"]) && isset($_SESSION["sessionPass"])) {
			return $this->login($_SESSION["sessionUser"], $_SESSION["sessionPass"]);
		}
	}

	function login($username, $password) {
		$this->isLoggedIn = false;

		$cleanUsername = $this->db->escape_string($username);
		$cleanPassword = $this->db->escape_string($password);

		// Evaluate credentials, either yea or nay
		$query = "SELECT * from console_users WHERE username = '{$cleanUsername}' LIMIT 1";
		$result = $this->db->query($query);
		$foundUser = ($this->db->num_rows($result) == 1);

	    if ($foundUser) {
	        $row = $this->db->read_row($result);

			$hashedPassword = $row["password"];
			if (validate_password($password, $hashedPassword)) {
	    			// If logged in, reveal your secrets
				$this->isLoggedIn = true;

				// Get user_id from user record
	        		$this->regionID = $row["console_user_id"];

	        		// Save session cookie
	        		$_SESSION["sessionUser"] = $cleanUsername;
	        		$_SESSION["sessionPass"] = $cleanPassword;
			}
	    }

		return $this->isLoggedIn;
	}

	function create_password_hash($password) {
		return create_hash($password);
	}

	function is_logged_in() {
		return $this->isLoggedIn;
	}

	function user_id() {
		return $this->userID;
	}

	function logout() {
	    unset($_SESSION["sessionUser"]);
	    unset($_SESSION["sessionPass"]);
		$this->isLoggedIn = false;
	}
}

?>
