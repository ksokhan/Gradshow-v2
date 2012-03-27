<?php
	require( '../upload/wp-load.php' );

	$id = $partial_options['id'];
	$img = $partial_options['image'];

	$user = get_userdata( $id );
	require('./libraries/php/getWork.php');
	//print_r($imgs);
?>
<!-- HEADER WITH PROJ TITLE, CLOSE BUTTON, STUDENT NAME & MEDIA -->
<header>
	<h1>
		<?php echo $imgs['data'][$img]['post_title'] ?>
	</h1>
	<h2>
		<?php echo $imgs['meta'][$img]['medium']['0'] ?>
	</h2>
	<h2>
		<?php echo $user->first_name . " " . $user->last_name ?>
	</h2>
</header>

<!-- LEFT COLUMN OF OVERLAY -->
<div id="overlay-left-column">
	<!-- MAIN IMAGE CONTAINER -->
	<div id="overlay-large-image">
		<?php
			// if no large image, just serve the medium size then...
			$largeImage = !empty ($imgs['sizes'][$img]['sizes']['large']) ? $imgs['sizes'][$img]['sizes']['large'] : $imgs['sizes'][$img]['sizes']['medium'];
			$w = $largeImage['width'];
			$h = $largeImage['height'];

			if ($w >= $h) {
				$h = 550 * ($h / $w);
				$w = 550;
			}
			else {
				$w = 550 * ($w / $h);
				$h = 550;
			}
		?>
		<img width="<?=$w?>" height="<?=$h?>" src="/upload/files/<?php $user = get_userdata( $id ); echo $user->user_nicename ?>/<?php echo $largeImage['file'] ?>" alt="project name">
	</div>

	<!-- CAPTION -->
	<!--<div id="olcaption">
		caption caption caption captio caption caption caption.
	</div>-->

	<!-- THUMBNAILS -->
	<div id="overlay-thumbnails">
		<?php
			echo overlayProjectThumbs($img);
		?>
	</div>
</div>

<!-- RIGHT COLUMN OF OVERLAY -->
<div id="overlay-right-column">

	<!-- DESCRIPTION -->
	<div id="overlay-description" class="nocase">
		<?php echo $imgs['data'][$img]['post_content'] ?>
	</div>

	<!-- STUDENT WORK LINK LIST -->
	<!--<div id="olmorework">
		<font class="ollisttitle">work by <?php echo $user->first_name . " " . $user->last_name ?></font>
		<ol class="worklist">
		      <?php
		        //echo imageTitleList();
		      ?>
		</ol>
	</div>-->

</div>