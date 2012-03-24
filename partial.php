<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$partial_name    = !empty ($_GET['partial_name']) ? str_replace ('/', '.', trim ($_GET['partial_name'], '/')) : 'home';
	$partial_options = array ();

	if (!empty ($_GET['options']))
	{
		// BLAH/POOP/LAME/PANTS/A/B
		$options_pieces = explode ('/', $_GET['options']);
		for ($i = 0; $i < count ($options_pieces); $i+=2) {
			$partial_options[$options_pieces[$i]] = $options_pieces[$i + 1];
		}
	}

	$partial_file = 'partials/'.$partial_name.'.php';

	if (file_exists ($partial_file)) {
		require $partial_file;
	}
	else {
		require 'pages/_error404.php';
	}
?>