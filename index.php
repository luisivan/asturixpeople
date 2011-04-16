<?php
require("config.php");
?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo NAME ?></title>
<link rel="icon" type="image/png" href="icon.png" />
<link rel="stylesheet" type="text/css" href="style.css" media="all">
<link rel="stylesheet" type="text/css" href="libs/jquery/jquery.validate.password.css" media="all">
</head>
<body>
<div id="header">
  <img id="logo" onclick="loadHome()" src="images/logo.png" />
  <div id="topbar">
  <button id="hotIdeasButton" onclick="viewHotIdeas()"><?php echo _('Hot') ?></button>
  <button id="hotIdeasButton" onclick="viewLastIdeas()"><?php echo _('Last') ?></button>
  <button id="approvedIdeasButton" onclick="viewApprovedIdeas()"><?php echo _('Approved') ?></button>
  <input id="search" type="search" placeholder="<?php echo _('Search...') ?>" onkeypress="onSearchButton(event)">
  <div id="loginBar"></div>
  </div>
</div>
<div id="wrapper">
<div id="sidebar">
  <div id="login"><label><?php echo _('User') ?></label><input id="user" type="text"><br />
		  <label><?php echo _('Pass') ?></label><input id="pass" type="password" onkeypress="onLoginEnter(event)"><br />
		  <button id="loginButton" onclick="onLoginButton()"><?php echo _('Login') ?></button><button id="forgotButton" onclick="onForgotButton()"><?php echo _('Forgot password?') ?></button>
  </div>
  <div id="categories" onchange="viewCategory(this.value)"></div>
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '#hashtag',
  interval: 6000,
  title: 'Title',
  subject: 'Subject',
  width: 'auto',
  height: 300,
  theme: {
    shell: {
      background: '#86DF86',
      color: '#353735'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    toptweets: true,
    behavior: 'default'
  }
}).render().start();
</script>
</div>
<div id="content">
</div>
</div>
<!--<div id="footer">
  Powered by <a href="http://asturix.com/people">Asturix People</a>
</div>-->
<script type="text/javascript" src="libs/jquery/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="libs/jquery/jquery.highlight.js"></script>
<script src="libs/history/jquery.history.js"></script>
<script type="text/javascript" src="urls.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="libs/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" src="libs/ckeditor/adapters/jquery.js"></script>-->
<script type="text/javascript" src="libs/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="libs/jquery/jquery.validate.password.js"></script>
<script src="libs/prettySociable/js/jquery.prettySociable.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="libs/prettySociable/css/prettySociable.css" type="text/css" media="screen" charset="utf-8" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php echo '<script type="text/javascript" src="libs/jquery/locale/messages_'.substr(LANG, 0, 2).'.js"></script>' ?>
</body>
</html>
