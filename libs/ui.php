<?php
class Ui {

	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function idea($idea, $resumed, $comment) {
		if ($idea != "")
		{	
		echo '<div class="idea" id="' . $idea["id"] . '">
		      <div class="ideaVotes">
		      <div class="ideaUp" id="' . $idea["id"] . '" onclick="voteIdeaUp(' . $idea["id"] . ')">' . $idea["up"] . '</div>
		      <div class="ideaAbstention" id="' . $idea["id"] . '" onclick="voteIdeaAbstention(' . $idea["id"] . ')">' . $idea["abstention"] . '</div>
		      <div class="ideaDown" id="' . $idea["id"] . '" onclick="voteIdeaDown(' . $idea["id"] . ')">' . $idea["down"] . '</div></div>';
		echo '<div class="ideaWrapper"><a class="ideaTitle" href="'.URL.'/#idea/'.$idea['id'].'" rel="prettySociable;title:'.$idea["name"].';excerpt:;" onclick="viewIdea(' . $idea["id"] . ')" id="' . $idea["id"] . '">' . $idea["name"] .' ';
		if ($idea["open"] == 1) {
			echo _('[Closed]');
		}

		if ($idea["karma"] >= KARMA)
		{
			echo _('[Approved]');
		}
		//echo $idea['karma'];
		$date = date('d-m-Y', $idea["date"]);
		echo '</a><div class="ideaMore"><div class="date" onclick="search(\'' . $date . '\')" id="' . $idea["id"] . '">' . $date . '</div><div class="byUser" onclick="viewProfile(\''.$idea["user"].'\')">' . $idea["user"] . '</div></div>';
		$desc = $idea["description"];
		if ($resumed==true)
		{
			$desc = substr($desc, 0, 250) . "...";
		}
		echo '<div class="ideaContent">' . $desc . '</a></div></div>';
		if ($this->db->isIdeaCreator($_SESSION["user"], $idea["id"])) {
			echo '<div class="ideaTools"><button class="deleteIdea" id="' . $idea["id"] . '" onclick="deleteIdea(' . $idea["id"] . ')">'. _('Delete idea') .'</button><button class="editIdea" id="' . $idea["id"] . '" onclick="editIdea(' . $idea["id"] . ')">'. _('Edit idea') .'</button></script></div>';
		}
		echo '</div>';
		if ($resumed == false)
		{
			echo '<script type="text/javascript" src="libs/jquery/jquery.resize.js"></script><script type="text/javascript" charset="utf-8">
			      $(document).ready(function(){
			      commentsIframe();
			      $.prettySociable();
			      });
			      </script>';
			echo '<iframe id="comments" onload="commentsIframe()" scrolling="no" allowtransparency="true" width="100%" height="auto" frameborder="0" src="ajax/comments.php?id='.$idea['id'].'" style="min-height:400px;"></iframe>';
		}
		}
	}

	public function user($user, $resumed) {
		if ($user != "")
		{
		echo '<div id="profile">
		      <a class="email" href="mailto:'.$user["email"].'">'.$user["email"].'</a>
		      <img class="photo" src="'.$user["photo"].'" width="70" height="70"/>
		      <h1 class="name" onclick="viewProfile(\''.$user["user"].'\')">'.$user["name"].'</h1>
		      <h2 class="user">'.$user["user"].'</h2>
		      <p class="info">'.$user["info"].'</p>
		      </div>';
		if ($_SESSION["user"] == $user["user"]) {
			echo '<button class="editProfile" id="' . $user["id"] . '" onclick="onProfileButton()">'. _('Edit profile') .'</button>';
		}
		}
	}

}

?>