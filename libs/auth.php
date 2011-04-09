<?php

class Auth {

	private $db;

	/*public function Auth() {
		$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
		$this->db->set_charset("utf8");
	}*/

	public function __construct($db) {
		$this->db = $db;
	}

	public function login($user, $pass) {
		if ($user == '' && $pass == '')
		{
			echo '<script>alert("'. _('Incorrect user or password') . '")</script>';
			return false;
		}
		$user = $this->db->db->real_escape_string($user);
		$passwd = $this->db->db->query("SELECT pass FROM users WHERE user='". $user . "'");
		$passwd = $passwd->fetch_array(MYSQLI_ASSOC);
		$passwd = $passwd["pass"];
		$pass = sha1($pass);
		if ($pass == $passwd)
		{
			$_SESSION["userid"] = $this->db->getId($user);
			$_SESSION["user"] = $user;
			$_SESSION["pass"] = $this->db->getPass($_SESSION["userid"]);
			$_SESSION["email"] = $this->db->getEmail($_SESSION["userid"]);
			$_SESSION["name"] = $this->db->getName($_SESSION["userid"]);
			$_SESSION["info"] = $this->db->getInfo($_SESSION["userid"]);
			$_SESSION["photo"] = $this->db->getPhoto($_SESSION["userid"]);
			return true;
		}
		else
		{
			echo '<script>alert("'. _('Incorrect user or password') . '")</script>';
			return false;
		}
	}

	public function loginWithEmailAndHash($email, $hash) {
		if ($email == '' && $hash == '')
		{
			echo '<script>alert("'. _('Incorrect email or hash') . '")</script>';
			return false;
		}
		$email = $this->db->db->real_escape_string($email);
		$passwd = $this->db->db->query("SELECT pass FROM users WHERE email='". $email . "'");
		$passwd = $passwd->fetch_array(MYSQLI_ASSOC);
		$passwd = $passwd["pass"];
		if ($hash == $passwd)
		{
			$_SESSION["userid"] = $this->db->getIdByEmail($email);
			$_SESSION["user"] = $this->db->getUsername($_SESSION["userid"]);
			$_SESSION["pass"] = $this->db->getPass($_SESSION["userid"]);
			$_SESSION["email"] = $this->db->getEmail($_SESSION["userid"]);
			$_SESSION["name"] = $this->db->getName($_SESSION["userid"]);
			$_SESSION["info"] = $this->db->getInfo($_SESSION["userid"]);
			$_SESSION["photo"] = $this->db->getPhoto($_SESSION["userid"]);
			return true;
		}
		else
		{
			echo '<script>alert("'. _('Incorrect email or hash') . '")</script>';
			return false;
		}
	}

	public function logout() {
		session_destroy();
	}

	public function isLogged() {
		if (isset($_SESSION["user"])) {
			return true;
		}
		return false;
	}

	public function loginBar($logged) {
		if ($logged == false) {
			return '<button id="loginButton" onclick="showLoginWidget()">'. _('Login') .'</button><button id="registerButton" onclick="onRegisterButton()">'. _('Sign up') .'</button>';
		} else {
			return '<script>$("#login").hide();</script><button id="logoutButton" onclick="onLogoutButton()">'. _('Logout') .'</button><button id="profileButton" onclick="viewProfile(\''.$_SESSION["user"].'\')">'.$_SESSION["user"].'</button><button id="newIdeaButton" onclick="onNewIdeaButton()">'. _('Send idea!') .'</button>';
		}
	}

	public function signUp($success) {
		if ($success == false) {
			echo '<script>alert("'. _('There was an error. Your username or your email may be registered') .'")</script>';
		} else {
			echo '<script>loadHome(); alert("'. _('Thanks! You are now registered! Check your mail!') .'";</script>';
		}
	}

	public function updateProfile($success) {
		if ($success == false) {
			echo '<div id="updateProfileError" class="error">'. _('There was an error. The username or email you wants may be registered') .'</div>';
		} else {
			echo '<div id="updateProfileSuccess" class="success">'. _('Thanks! Your profile is now updated! Your new username is: ') . $_SESSION["user"] . _('and your new password is ') . $_SESSION["pass"] . '</div><script>$("#signUp").fadeOut();$("#signUpError").fadeOut();</script>';
		}
	}

	public function forgotPassword($email) {
		$email = $this->db->db->real_escape_string($email);
		if ($this->db->getPassByEmail($email) != "")
		{
			$to = $email;
			$subject = _('Your ') . NAME . _(' password');
			$message = _('If you have lost your ') . NAME . _(' password, you can recover it clicking the following link: ') . '<a href="'.URL.'/#recover/'.$email.'/'.$this->db->getPassByEmail($email).'">'. _('Recover password') .'</a>';
			$headers = 'From: webmaster@' . HOST . "\r\n" .
			    'Reply-To: webmaster@' . HOST . "\r\n" .
			    'X-Mailer: PHP/' . phpversion() . "\r\n" .
			    'MIME-Version: 1.0' . "\r\n" . 
			    'Content-type: text/html; charset=utf-8' . "\r\n";

			mail($to, $subject, $message, $headers);
			echo '<script>alert("'. _('Check your mail!') .'"); loadHome();</script>';
		} else {
			echo '<script>alert("'. _('Hey cowboy, the thing you are trying is forbidden') .'")</script>';
		}
	}

	public function recoverPassword($email, $hash) {
		$email = $this->db->db->real_escape_string($email);
		$hash = $this->db->db->real_escape_string($hash);
		if ($this->loginWithEmailAndHash($email, $hash) == true) {
			echo '<script>loadLoginWidget(); onPasswordButton()</script>';
		}
	}
}

?>