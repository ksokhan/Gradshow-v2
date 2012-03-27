<div id="page-wrapper" class="three-columns">
	<section id="content">
		<div id="thumbnails">
			<?php
				require( './upload/wp-load.php' );
				include('./libraries/php/getStudents.php');

				/*for ($i = 0; $i < 105; $i++) {
					$random_first_name = $letters[array_rand ($letters)];
					$random_last_name = $letters[array_rand ($letters)];

					echo '
						<div class="thumbnail student" data-first-name="'.$random_first_name.'" data-last-name="'.$random_last_name.'" title="'.$random_first_name.' '.$random_last_name.'">
							<a href="#">'.$random_first_name.' '.$random_last_name.'</a>

							<div class="caption">
								'.$random_first_name.' '.$random_last_name.'
							</div>
						</div>
					';
				}*/
			?>
		</div>
	</section>

	<section id="left" class="sidebar">
		<h1>FRIENDS + FAMILY</h1>
		<p>
			APRIL 15<br>
			6:00PM &ndash; 10:00PM
		</p>

		<h1>INDUSTRY NIGHT</h1>
		<p>
			APRIL 16<br>
			6:00PM &ndash; 10:00PM
		</p>

		<h1>DOORS OPEN</h1>
		<p>
			APRIL 16 &amp; 17<br>
			10:00AM &ndash; 4:00PM
		</p>
	</section>

	<section id="right" class="sidebar">
		<h1>sort by</h1>
		<ul>
			<li><a href="#" id="sort_randomly">Random</a></li>
			<li><a href="#" id="sort_by_first_name">First Name</a></li>
			<li><a href="#" id="sort_by_last_name">Last Name</a></li>
		</ul>

		<h1>filter by</h1>
		<ul id="letters">
			<li><a href="#" data-show-only-letter="all">All</a></li>
			<?php
				$letters = array ();
				for ($i = 'a'; $i <= 'z'; $i++) {
					$letters[] = $i;
					if ($i == 'z') break;
				}

				foreach ($letters as $letter)
				{
					echo '
						<li><a href="#" data-show-only-letter="'.$letter.'">'.ucfirst ($letter).'</a></li>
					';
				}
			?>
		</ul>
	</section>
</div>