<div id="page-wrapper" class="three-columns">
	<section id="content">
		<?php
		require( '../upload/wp-load.php' );
		$id = $page_options['id'];
		$user = get_userdata( $id );
	  	require( './libraries/php/getWork.php' );

	  	echo drawUserImages();

		?>
	</section>

	<section id="left" class="sidebar">
		<h1>FRIENDS + FAMILY</h1>
		<p>
			APRIL 15<br>
			6:30PM - 10:00PM
		</p>

		<h1>INDUSTRY NIGHT</h1>
		<p>
			APRIL 16<br>
			6:30 - 10:00PM
		</p>

		<h1>DOORS OPEN</h1>
		<p>
			APRIL 16 &amp; 17<br>
			10:00AM &mdash; 4:00PM
		</p>
	</section>

	<section id="right" class="sidebar">
		right sidebar
	</section>
</div>