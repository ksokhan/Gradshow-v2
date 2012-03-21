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

		<?php
			if (file_exists ('js/'.$_GET['page'].'.js')) {
				echo '<script type="text/javascript" src="js/'.$_GET['page'].'.js"></script>';
			}
		?>
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

		<footer>

		</footer>
	</body>
</html>