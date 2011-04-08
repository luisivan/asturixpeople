<?php

require("../config.php");

$id=$_GET["id"];

$idea=$db->getIdea($id);

echo '<script type="text/javascript">
      if (window==window.top)
      {
	document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"../style.css\" media=\"all\"><div id=\"commentsHeader\"><a href=\"'.URL.'/#idea/'.$id.'\" id=\"commentsReturn\">&larr; '. _('Return to the idea') .'</a><a href=\"'.URL.'/#idea/'.$id.'\" id=\"commentsTitle\">'. _('Comments of ') . '<i>' . $idea['name'] .'</i></a></div>");
      }
      </script>';

echo '<div id="disqus_thread"></div>
      <script type="text/javascript">
      var disqus_shortname = "'.DISQUS.'";
      //var disqus_identifier = "idea_'.$id.'";
      var disqus_title = "'.$idea['name'].'";
      //var disqus_url = "'.URL.'/#idea/'.$id.'";
      //var disqus_href = "'.URL.'/#idea/'.$id.'";
      //var disqus_thread_slug = "idea_'.$id.'";
      (function() {
		var dsq = document.createElement("script"); dsq.type = "text/javascript"; dsq.async = true;
		dsq.src = "http://" + disqus_shortname + ".disqus.com/embed.js";
		(document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(dsq);
      })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>';
?>