<div id="page-wrapper" class="three-columns">


	<section id="content">
		<?php
			require( '../upload/wp-load.php' );

			$id = $page_options['id'];
			$user = get_userdata( $id );

		  	require( './libraries/php/getWork.php' );

		  	echo drawUserImages();

		  	if (!empty ($user->description))
		  	{
		  		echo '
		  			<div id="bio">
						'.$user->description.'
						<a href="#" id="close-bio">&times;</a>
					</div>
		  		';
		  	}
		?>
	</section>

	<section id="left" class="sidebar">
		<h1>FRIENDS + FAMILY</h1>
		<p>
			APRIL 15<br>
			6:30PM &ndash; 10:00PM
		</p>

		<h1>INDUSTRY NIGHT</h1>
		<p>
			APRIL 16<br>
			6:30PM &ndash; 10:00PM
		</p>

		<h1>DOORS OPEN</h1>
		<p>
			APRIL 16 &amp; 17<br>
			10:00AM &ndash; 4:00PM
		</p>

		<p>
			<a id="back-button" href="<?php if ($page_options['action'] == "overlay") { echo "/gallery"; } else { echo "/students"; } ?>">&larr; Back</a>
		</p>

	</section>

	<section id="right" class="sidebar studentProfile">
		<h1><?php echo $user->first_name . " " . $user->last_name ?></h1>
  		<img class="photo" src="/images/student-image-profiles/<?php echo str_replace(' ', '_', $user->first_name) . "_" . str_replace(' ', '_', $user->last_name) ?>02.jpg">

 		<h2>Contact</h2>
 		<p><a href="mailto:<?php echo $user->user_email ?>" "email me"><?php echo $user->user_email ?></a></p>
		<p><a href="<?php echo $user->user_url ?>"><?php echo $user->user_url ?></a></p>

		<h2>Projects</h2>
		<ol>
	      <?php
	          echo imageTitleList();
	      ?>
	    </ol>
	</section>
</div>
