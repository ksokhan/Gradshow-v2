<div id="page-wrapper" class="three-columns">
	<section id="content">
		<?php
			for ($i = 0; $i < 5; $i++) {
				$random_width = rand(100,300);
				$random_height = rand(100,300);

				echo '
					<div style="width: '.$random_width.'px; height: '.$random_height.'px;" class="poster" data-course="" data-medium="" title="PROJECT NAME&lt;br&gt;Aaron Wright">
						I AM A WORK
					</div>
				';
			}
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