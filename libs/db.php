<?php
class Db {
	public $db;

	/*public function Db() {
		$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
		$this->db->set_charset("utf8");
	}*/

	public function __construct() {
		$this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
		$this->db->set_charset("utf8");
		require_once 'purifier/HTMLPurifier.standalone.php';
		
		$config = HTMLPurifier_Config::createDefault();
		$config->set('Core.Encoding', 'UTF-8');
		$config->set('HTML.Doctype', 'HTML 4.01 Transitional');
		$this->purifier = new HTMLPurifier($config);
	}

	public function writeUser($user, $pass, $email, $name, $info, $photo) {
		$user = $this->db->real_escape_string($user);
		$email = $this->db->real_escape_string($email);
		if ($this->userExists($user) == true)
		{
			return false;
		}
		if ($this->emailExists($email) == true)
		{
			return false;
		}
		//$pass = $this->db->real_escape_string($pass);
		$pass = sha1($pass);
		$name = $this->db->real_escape_string($name);
		$info = $this->purifier->purify($info);
		$info = $this->db->real_escape_string($info);
		$photo = $this->db->real_escape_string($photo);
		$result = $this->db->query("INSERT INTO users VALUES ('', '". $user ."', '". $pass ."', '". $email ."', '". $name ."', '". $info ."', '". $photo ."')");
		
		return true;
	}

	public function writeIdea($name, $description, $user, $cat) {
		$name = $this->purifier->purify($name);
		$name = $this->db->real_escape_string($name);
		$description = $this->purifier->purify($description);
		$description = $this->db->real_escape_string($description);
		$user = $this->db->real_escape_string($user);
		$cat = $this->db->real_escape_string($cat);
		$this->db->query("INSERT INTO ideas VALUES ('', '". $name ."', '". $description ."', '0', '0', '0', '0', '". $user ."', '".time()."', '".$cat."', '0')");
	}

	public function updateUser($id, $user, $email, $name, $info, $photo) {
		$id = $this->db->real_escape_string($id);
		$user = $this->db->real_escape_string($user);
		$email = $this->db->real_escape_string($email);
		if ($_SESSION['user'] != $user) {
			if ($this->userExists($user) == true)
			{
				echo '<script>alert("'. _('Hey this username is already in use!') . '")</script>';
			}
		}
		if ($_SESSION['email'] != $email) {
			if ($this->emailExists($email) == true)
			{
				echo '<script>alert("'. _('Hey this email is already in use!') . '")</script>';
			}
		}
		$name = $this->purifier->purify($name);
		$name = $this->db->real_escape_string($name);
		$info = $this->purifier->purify($info);
		$info = $this->db->real_escape_string($info);
		$photo = $this->db->real_escape_string($photo);
		$result = $this->db->query("UPDATE users SET user='". $user ."', email='". $email ."', name='". $name ."', info='". $info ."', photo='". $photo ."' WHERE id='".$id."'");
		echo "<script>viewProfile('".$user."');</script>";
	}

	public function updatePassword($id, $pass) {
		$id = $this->db->real_escape_string($id);
		$pass = sha1($pass);
		$this->db->query("UPDATE users SET pass='". $pass ."' WHERE id='".$id."'");
		echo "<script>viewProfile('".$this->getUserName($id)."');</script>";
	}

	public function updateIdea($id, $name, $description, $open, $cat) {
		$name = $this->purifier->purify($name);
		$name = $this->db->real_escape_string($name);
		$description = $this->purifier->purify($description);
		$description = $this->db->real_escape_string($description);
		$open = $this->db->real_escape_string($open);
		$cat = $this->db->real_escape_string($cat);
		$this->db->query("UPDATE ideas SET name='". $name ."', description='". $description ."', open='". $open ."', date='".time()."', category='".$cat."' WHERE id='" . $id . "'");
	}

	public function deleteUser($user) {
		$user = $this->db->real_escape_string($user);
		if (isset($_SESSION['user']) && $_SESSION['user'] == $user) {
			$this->db->query("DELETE FROM users WHERE user='" . $user . "'");
			return true;
		}
		return false;
	}

	public function deleteUserById($id) {
		$id = $this->db->real_escape_string($id);
		$this->db->query("DELETE FROM users WHERE id='" . $id . "'");
	}

	public function deleteIdea($id) {
		$id = $this->db->real_escape_string($id);
		$this->db->query("DELETE FROM ideas WHERE id='" . $id . "'");
		$this->db->query("DELETE FROM votes WHERE ideaid='" . $id . "'");
	}

	public function userExists($user) {
		$user = $this->db->real_escape_string($user);
		$userdb = $this->db->query("SELECT user FROM users WHERE user='". $user . "'");
		$userdb = $userdb->fetch_array(MYSQLI_NUM);
		$userdb = $userdb[0];
		if ($user == $userdb) {
			return true;
		} else {
			return false;
		}
	}

	public function emailExists($email) {
		$email = $this->db->real_escape_string($email);
		$emaildb = $this->db->query("SELECT email FROM users WHERE email='". $email . "'");
		$emaildb = $emaildb->fetch_array(MYSQLI_NUM);
		$emaildb = $emaildb[0];
		if ($email == $emaildb) {
			return true;
		} else {
			return false;
		}
		
	}

	public function getUser($id) {
		$id = $this->db->real_escape_string($id);
		$user = $this->db->query("SELECT * FROM users WHERE id='". $id . "'");
		$user = $user->fetch_array(MYSQLI_ASSOC);
		return $user;
	}

	public function getId($user) {
		$user = $this->db->real_escape_string($user);
		$id = $this->db->query("SELECT id FROM users WHERE user='". $user . "'");
		$id = $id->fetch_array(MYSQLI_NUM);
		$id = $id[0];
		return $id;
	}

	public function getIdByEmail($email) {
		$email = $this->db->real_escape_string($email);
		$id = $this->db->query("SELECT id FROM users WHERE email='". $email . "'");
		$id = $id->fetch_array(MYSQLI_NUM);
		$id = $id[0];
		return $id;
	}

	public function getUserName($id) {
		$id = $this->db->real_escape_string($id);
		$user = $this->db->query("SELECT user FROM users WHERE id='". $id . "'");
		$user = $user->fetch_array(MYSQLI_NUM);
		$user = $user[0];
		return $user;
	}

	public function getPass($id) {
		$id = $this->db->real_escape_string($id);
		$pass = $this->db->query("SELECT pass FROM users WHERE id='". $id . "'");
		$pass = $pass->fetch_array(MYSQLI_NUM);
		$pass = $pass[0];
		return $pass;
	}

	public function getEmail($id) {
		$id = $this->db->real_escape_string($id);
		$email = $this->db->query("SELECT email FROM users WHERE id='". $id . "'");
		$email = $email->fetch_array(MYSQLI_NUM);
		$email = $email[0];
		return $email;
	}

	public function getName($id) {
		$id = $this->db->real_escape_string($id);
		$name = $this->db->query("SELECT name FROM users WHERE id='". $id . "'");
		$name = $name->fetch_array(MYSQLI_NUM);
		$name = $name[0];
		return $name;
	}

	public function getInfo($id) {
		$id = $this->db->real_escape_string($id);
		$info = $this->db->query("SELECT info FROM users WHERE id='". $id . "'");
		$info = $info->fetch_array(MYSQLI_NUM);
		$info = $info[0];
		return $info;
	}

	public function getPhoto($id) {
		$id = $this->db->real_escape_string($id);
		$photo = $this->db->query("SELECT photo FROM users WHERE id='". $id . "'");
		$photo = $photo->fetch_array(MYSQLI_NUM);
		$photo = $photo[0];
		return $photo;
	}

	public function getPassByEmail($email) {
		$email = $this->db->real_escape_string($email);
		$pass = $this->db->query("SELECT pass FROM users WHERE email='". $email . "'");
		$pass = $pass->fetch_array(MYSQLI_NUM);
		$pass = $pass[0];
		return $pass;
	}

	public function getIdea($id) {
		$id = $this->db->real_escape_string($id);
		$idea = $this->db->query("SELECT * FROM ideas WHERE id='". $id . "'");
		$idea = $idea->fetch_array(MYSQLI_ASSOC);
		//$idea = $idea[0];
		return $idea;
	}

	public function getIdeaUpVotes($id) {
		$id = $this->db->real_escape_string($id);
		$idea = $this->db->query("SELECT up FROM ideas WHERE id='". $id . "'");
		$idea = $idea->fetch_array(MYSQLI_NUM);
		$idea = $idea[0];
		return $idea;
	}

	public function getIdeaDownVotes($id) {
		$id = $this->db->real_escape_string($id);
		$idea = $this->db->query("SELECT down FROM ideas WHERE id='". $id . "'");
		$idea = $idea->fetch_array(MYSQLI_NUM);
		$idea = $idea[0];
		return $idea;
	}

	public function getIdeaAbstentionVotes($id) {
		$id = $this->db->real_escape_string($id);
		$idea = $this->db->query("SELECT abstention FROM ideas WHERE id='". $id . "'");
		$idea = $idea->fetch_array(MYSQLI_NUM);
		$idea = $idea[0];
		return $idea;
	}

	public function getNumberOfIdeas() {
		$ideas = $this->db->query("SELECT COUNT(*) FROM ideas");
		$ideas = $ideas->fetch_array(MYSQLI_NUM);
		$ideas = $ideas[0];
		return $ideas;
	}

	public function getNumberOfIdeasByCat($id) {
		$id = $this->db->real_escape_string($id);
		$ideas = $this->db->query("SELECT COUNT(*) FROM ideas WHERE category=".$id);
		$ideas = $ideas->fetch_array(MYSQLI_NUM);
		$ideas = $ideas[0];
		return $ideas;
	}

	public function getNumberOfHotIdeas() {
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$ideas = $this->db->query("SELECT COUNT(*) FROM ideas WHERE karma < ".KARMA);
		$ideas = $ideas->fetch_array(MYSQLI_NUM);
		$ideas = $ideas[0];
		return $ideas;
	}

	public function getNumberOfApprovedIdeas() {
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$ideas = $this->db->query("SELECT COUNT(*) FROM ideas WHERE karma >= ".KARMA);
		$ideas = $ideas->fetch_array(MYSQLI_NUM);
		$ideas = $ideas[0];
		return $ideas;
	}

	public function voteIdeaUp($id) {
		$id = $this->db->real_escape_string($id);
		$this->db->query("UPDATE ideas SET up=up + 1 WHERE id='" . $id . "'");
		$this->db->query("UPDATE ideas SET karma=karma + 1 WHERE id='" . $id . "'");
		$this->db->query("INSERT INTO votes VALUES ('". $id ."', '". $_SESSION['userid'] ."', '0')");
	}

	public function voteIdeaDown($id) {
		$id = $this->db->real_escape_string($id);
		$this->db->query("UPDATE ideas SET down=down + 1 WHERE id='" . $id . "'");
		$this->db->query("UPDATE ideas SET karma=karma - 1 WHERE id='" . $id . "'");
		$this->db->query("INSERT INTO votes VALUES ('". $id ."', '". $_SESSION['userid'] ."', '1')");
	}

	public function voteIdeaAbstention($id) {
		$id = $this->db->real_escape_string($id);
		$this->db->query("UPDATE ideas SET abstention=abstention + 1 WHERE id='" . $id . "'");
		$this->db->query("UPDATE ideas SET karma=karma + 0.5 WHERE id='" . $id . "'");
		$this->db->query("INSERT INTO votes VALUES ('". $id ."', '". $_SESSION['userid'] ."', '2')");
	}

	public function userVotedIdea($ideaid, $userid) {
		$ideaid = $this->db->real_escape_string($ideaid);
		$userid = $this->db->real_escape_string($userid);
		$vote = $this->db->query("SELECT vote FROM votes WHERE ideaid='" . $ideaid . "' AND userid='" . $userid . "'");
		$vote = $vote->fetch_array(MYSQLI_NUM);
		$vote = $vote[0];
		if ($vote == "") {
			return false;
		} else {
			return "'" . $vote . "'";
		}
	}

	/*public function changeUserVote($ideaid, $userid) {
		$ideaid = $this->db->real_escape_string($ideaid);
		$userid = $this->db->real_escape_string($userid);
		$oldvote = $this->userVotedIdea($ideaid, $userid);
		$this->db->query("DELETE FROM votes WHERE ideaid='" . $ideaid . "' AND userid='" . $userid . "'");
		if ($oldvote == '0') {
			return false;
		} else if ($oldvote == '1') {
			return false;
		} else {
			return "'" . $vote . "'";
		}
	}*/

	public function isIdeaCreator($user, $ideaid) {
		$ideaid = $this->db->real_escape_string($ideaid);
		$user = $this->db->real_escape_string($user);
		if (isset($_SESSION['user']) && $_SESSION['user'] == $user) {
			$is = $this->db->query("SELECT user FROM ideas WHERE id='" . $ideaid . "' AND user='" . $user . "'");
			$is = $is->fetch_array(MYSQLI_NUM);
			$is = $is[0];
			if ($is == $_SESSION['user']) {
				return true;
			}
			return false;
		}
		return false;
	}

	public function getCategory($id) {
		$id = $this->db->real_escape_string($id);
		$name = $this->db->query("SELECT name FROM categories WHERE id='". $id . "'");
		$name = $name->fetch_array(MYSQLI_NUM);
		$name = $name[0];
		return $name;
	}

	public function getCategories() {
		$cats = $this->db->query("SELECT * FROM categories");
		return $cats;
	}

	public function getCategoryIdeas($catid, $page) {
		$catid = $this->db->real_escape_string($catid);
		$page = $this->db->real_escape_string($page);
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$ideas = $this->db->query("SELECT * FROM ideas WHERE category='". $catid ."' ORDER BY up DESC LIMIT ". $items .", ". ITEMS);
		return $ideas;
	}

	public function getIdeaCategory($id) {
		$id = $this->db->real_escape_string($id);
		$cat = $this->db->query("SELECT category FROM ideas WHERE id='". $id ."'");
		$cat = $cat->fetch_array(MYSQLI_NUM);
		$cat = $cat[0];
		return $cat;
	}

	public function search($text, $page) {
		$text = $this->db->real_escape_string($text);
		$page = $this->db->real_escape_string($page);
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$date = substr(strtotime($text), 0, 5);
		if ($date != 0) {
			$ideas = $this->db->query("SELECT * FROM ideas WHERE name LIKE '%". $text ."%' OR description  LIKE '%". $text ."%' OR user LIKE '%". $text ."%' OR date LIKE '". $date ."%' LIMIT ". $items .", ". ITEMS);
		} else {
			$ideas = $this->db->query("SELECT * FROM ideas WHERE name LIKE '%". $text ."%' OR description  LIKE '%". $text ."%' OR user LIKE '%". $text ."%' LIMIT ". $items .", ". ITEMS);
		}
		return $ideas;
	}

	public function searchAccounts($text, $page) {
		$text = $this->db->real_escape_string($text);
		$page = $this->db->real_escape_string($page);
		$items2 = $page * ITEMS;
		$items1 = $items2 - ITEMS;
		$users = $this->db->query("SELECT * FROM users WHERE user LIKE '%". $text ."%' OR email LIKE '%". $text ."%' OR name LIKE '%". $text ."%' LIMIT ". $items1 .", ". $items2);
		return $users;
	}

	public function getNumberOfSearchResults($text) {
		$text = $this->db->real_escape_string($text);
		$ideas = $this->db->query("SELECT COUNT(*) FROM ideas WHERE name LIKE '%". $text ."%' OR description  LIKE '%". $text ."%' OR user LIKE '%". $text ."%'");
		$ideas = $ideas->fetch_array(MYSQLI_NUM);
		return $ideas[0];
	}

	public function getIdeas() {
		$ideas = $this->db->query("SELECT * FROM ideas");
		return $ideas;
	}

	public function getHotIdeas($page) {
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$ideas = $this->db->query("SELECT * FROM ideas WHERE karma < ".KARMA." ORDER BY karma DESC LIMIT ". $items .", ". ITEMS);
		return $ideas;
	}

	public function getNewIdeas($page) {
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$ideas = $this->db->query("SELECT * FROM ideas ORDER BY date DESC LIMIT ". $items .", ". ITEMS);
		return $ideas;
	}

	public function getApprovedIdeas($page) {
		$items1 = $page * ITEMS;
		$items = $items1 - ITEMS;
		$ideas = $this->db->query("SELECT * FROM ideas WHERE karma >= ".KARMA." ORDER BY date DESC LIMIT ". $items .", ". ITEMS);
		return $ideas;
	}

	public function getIdeaKarma($id) {
		/*$id = $this->db->real_escape_string($id);
		$up = $this->getIdeaUpVotes($id);
		$down = $this->getIdeaDownVotes($id);
		$abstention = $this->getIdeaAbstentionVotes($id);
		$karma = $up - $down + ($abstention*0.5);
		return $karma;*/
	}

	public function isIdeaOpen($id) {
		$id = $this->db->real_escape_string($id);
		$open = $this->db->query("SELECT open FROM ideas WHERE id='". $id ."'");
		$open = $open->fetch_array(MYSQLI_NUM);
		$open = $open[0];
		return $open;
	}

	public function getUsers() {
		$users = $this->db->query("SELECT * FROM users");
		return $users;
	}
}

?>