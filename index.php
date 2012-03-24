<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	// LESS COMPILER
	// ================================
	include "./libraries/less/lessc.inc.php";

	function auto_compile_less($less_fname, $css_fname) {
	  // load the cache
	  $cache_fname = $less_fname.".cache";
	  if (file_exists($cache_fname)) {
	    $cache = unserialize(file_get_contents($cache_fname));
	  } else {
	    $cache = $less_fname;
	  }

	  $new_cache = lessc::cexecute($cache);
	  if (!is_array($cache) || $new_cache['updated'] > $cache['updated']) {
	    file_put_contents($cache_fname, serialize($new_cache));
	    file_put_contents($css_fname, $new_cache['compiled']);
	  }
	}
	// ================================

	$page_name    = !empty ($_GET['page_name']) ? str_replace ('/', '.', trim ($_GET['page_name'], '/')) : 'home';
	$page_options = array ();

	if (!empty ($_GET['options']))
	{
		// BLAH/POOP/LAME/PANTS/A/B
		$options_pieces = explode ('/', $_GET['options']);
		for ($i = 0; $i < count ($options_pieces); $i+=2) {
			$page_options[$options_pieces[$i]] = $options_pieces[$i + 1];
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">

		<title>PIQUE</title>
		<?php
			auto_compile_less('./less/_global.less', './css/_global.css');
		?>
		<link rel="stylesheet" type="text/css" href="/css/html5reset.css" media="all">
		<link rel="stylesheet" type="text/css" href="/css/_global.css" media="all">
		<?php

			if (file_exists ('./less/'.$page_name.'.less')) {
				auto_compile_less('./less/' . $page_name. '.less', './css/' . $page_name . '.css');
				echo '<link rel="stylesheet" type="text/css" href="/css/'.$page_name.'.css" media="all">';
			}
		?>

		<script type="text/javascript" src="/libraries/mootools/moo.core.1.4.5.js"></script>
		<script type="text/javascript" src="/libraries/mootools/moo.more.1.4.0.1.js"></script>
		<script type="text/javascript" src="/libraries/mootools/LazyLoad.js"></script>

		<script type="text/javascript" src="http://fast.fonts.com/jsapi/23779f16-a0da-4258-b1bd-964665cab549.js"></script>

		<script type="text/javascript" src="/js/_global.js"></script>

		<?php
			if (file_exists ('js/'.$page_name.'.js')) {
				echo '<script type="text/javascript" src="/js/'.$page_name.'.js"></script>';
			}
		?>
	</head>

	<?php
		$colour_scheme = !empty ($_COOKIE['pique-bg-colour']) ? str_replace ('set-bg-', '', $_COOKIE['pique-bg-colour']) : 'white';
	?>
	<body id="<?=$colour_scheme?>">
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
					$current_page[$page_name] = ' class="current_page"';
				?>
				<li<?=@$current_page['about']?>><a href="/about">About</a></li>
				<li<?=@$current_page['students']?>><a href="/students">Students</a></li>
				<li<?=@$current_page['gallery']?>><a href="/gallery">Gallery</a></li>
				<li<?=@$current_page['video']?>><a href="/video">Video</a></li>
			</ul>
		</nav>

		<?php
			$page_file = 'pages/'.$page_name.'.php';

			if (file_exists ($page_file)) {
				require $page_file;
			}
			else {
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
			<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&amp;include_rts=false&amp;screen_name=ysdn12&amp;count=1&amp;callback=twitterCallback2"></script>
		</footer>
	</body>
</html>
