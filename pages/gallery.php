<div id="page-wrapper" class="three-columns">
	<section id="content">
		<div id="thumbnails" class="gallery">
			<?php
				require('../upload/wp-load.php');
				// we want all users
				// so leave it blank
				$id = "gallery";

				require('./libraries/php/getWork.php');


				$courses = array (
					'Typography',
					'Typeface Design',
					'Communication Design',
					'Design and Systems',
					'Interactivity Design',
					'Time-Based Communication',
					'Package Design',
					'Editorial Design',
					'Information Design',
					'Contemporary Problems in Design',
					'Design for Public Awareness',
					'Self, Society and Design',
					'Image and Influence',
					'Design Internship',
					'Design in Interactive Environments',
					'Type in Motion',
					'Interactive System Design',
					'Design Workshop',
					'Book Design',
					'Professional Aspects of Design',
					'Independent Studies'
				);
				$mediums = array (
					'3D',
					'Book',
					'Editorial',
					'Typography',
					'Poster',
					'Motion',
					'Interactive',
					'Identity',
					'Information'
				);

				echo drawAllImages();

			?>
		</div>
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
		<h1>sort by</h1>
		<ul>
			<li><a href="#" id="sort_randomly">Random</a></li>
			<li><a href="#" id="sort_by_medium">Medium</a></li>
			<li><a href="#" id="sort_by_course">Course</a></li>
		</ul>

		<h1>filter by medium</h1>
		<ul>
			<li><a href="#" data-show-only-medium="all">All</a></li>
			<?php
				foreach ($mediums as $medium)
				{
					$course_converted = str_replace(' ', '-', strtolower($course));

				    $count = $wpdb->get_results("
				        SELECT COUNT(meta_key)
				        FROM $wpdb->postmeta
				        WHERE meta_value = '$course_converted'
				        AND meta_key = 'course'

				    ", ARRAY_A );
				    if ($count[0]['COUNT(meta_key)'] != '0') {
						echo '<li><a href="#" data-show-only-medium="'. strtolower($medium).'">'.$medium.'</a></li>';
					}
				}
			?>
		</ul>

		<h1>filter by course</h1>
		<ul>
			<li><a href="#" data-show-only-course="all">All</a></li>
			<?php
				foreach ($courses as $course)
				{
					$course_converted = str_replace(' ', '-', strtolower($course));

				    $count = $wpdb->get_results("
				        SELECT COUNT(meta_key)
				        FROM $wpdb->postmeta
				        WHERE meta_value = '$course_converted'
				        AND meta_key = 'course'

				    ", ARRAY_A );
					//print_r($count);
					//
				    if ($count[0]['COUNT(meta_key)'] != '0') {
				    	echo '<li><a href="#" data-show-only-course="'. $course_converted .'">'.$course.'</a></li>';
				    }

				}
			?>
		</ul>
	</section>
</div>