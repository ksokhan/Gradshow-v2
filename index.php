<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">

		<title>PIQUE</title>

		<link rel="stylesheet" type="text/css" href="css/html5reset.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/_global.css" media="all">
		<?php
			if (file_exists ('css/'.$_GET['page'].'.css')) {
				echo '<link rel="stylesheet" type="text/css" href="css/'.$_GET['page'].'.css" media="all">';
			}
		?>

		<script type="text/javascript" src="libraries/mootools/moo.core.1.4.5.js"></script>
		<script type="text/javascript" src="libraries/mootools/moo.more.1.4.0.1.js"></script>

		<script type="text/javascript" src="http://fast.fonts.com/jsapi/23779f16-a0da-4258-b1bd-964665cab549.js"></script>

		<script type="text/javascript" src="js/_global.js"></script>

		<?php
			if (file_exists ('js/'.$_GET['page'].'.js')) {
				echo '<script type="text/javascript" src="js/'.$_GET['page'].'.js"></script>';
			}
		?>
	</head>

	<body id="white">
		<header>
			<h1 id="logo"><a href="#">York / Sheridan Design Pique Grad Show</a></h1>

			<div id="days-and-hours" class="timer">
				<div id="days-left">
					<var>25</var> D
				</div>
				<div id="hours-left">
					<var>20</var> H
				</div>
			</div>
			<div id="minutes-and-seconds" class="timer">
				<div id="minutes-left">
					<var>25</var> M
				</div>
				<div id="seconds-left">
					<var>20</var> S
				</div>
			</div>
		</header>

		<nav id="main-navigation">
			<ul>
				<?php
					$current_page[$_GET['page']] = ' class="current_page"';
				?>
				<li<?=@$current_page['about']?>><a href="/about">About</a></li>
				<li<?=@$current_page['students']?>><a href="/students">Students</a></li>
				<li<?=@$current_page['gallery']?>><a href="/gallery">Gallery</a></li>
				<li<?=@$current_page['video']?>><a href="/video">Video</a></li>
			</ul>
		</nav>

		<?php
			$page_file = isset ($_GET['page']) ? 'pages/'.$_GET['page'].'.php' : 'pages/home.php';

			if (file_exists ($page_file)) {
				require $page_file;
			}
			else
			{
				require 'pages/_error404.php';
			}
		?>

		<footer id="main-footer">
			<ul id="colour-picker">
				<li id="set-bg-white" class="active"><a href="#">White</a></li>
				<li id="set-bg-yellow"><a href="#">Yellow</a></li>
				<li id="set-bg-seafoam"><a href="#">Seafoam</a></li>
				<li id="set-bg-red"><a href="#">Red</a></li>
				<li id="set-bg-navy"><a href="#">Navy</a></li>
			</ul>

			<div id="social-media">
				<ul id="twitter_update_list"><li>Twitter feed loading...</li></ul>
				<ul id="social-links">
					<li id="social-media-facebook"><a href="http://www.facebook.com/events/269791449767810/">Pique2012 on Facebook</a></li>
					<li id="social-media-twitter"><a href="https://twitter.com/#!/ysdn12">Pique2012 on Twitter</a></li>
				</ul>
			</div>
			<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/ysdn12.json?callback=twitterCallback2&count=1"></script>
		</footer>
	</body>
</html>