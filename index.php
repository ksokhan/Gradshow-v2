<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">

		<title>PIQUE</title>

		<link rel="stylesheet" type="text/css" href="css/html5reset.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/_global.css" media="all">

		<script type="text/javascript" src="libraries/mootools/moo.core.1.4.5.js"></script>
		<script type="text/javascript" src="libraries/mootools/moo.more.1.4.0.1.js"></script>

		<script type="text/javascript" src="http://fast.fonts.com/jsapi/23779f16-a0da-4258-b1bd-964665cab549.js"></script>

		<script type="text/javascript" src="js/_global.js"></script>

		<script type="text/javascript" src="js/gallery.js"></script>
	</head>

	<body id="navy">
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
				<li><a href="#">About</a></li>
				<li><a href="#">Students</a></li>
				<li class="current_page"><a href="#">Gallery</a></li>
				<li><a href="#">Video</a></li>
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

		<footer>

		</footer>
	</body>
</html>