<div id="page-wrapper" class="three-columns">
	<section id="content">
		<div id="thumbnails">
			<?php
				$courses = array (
					'Book Design',
					'Corporate ID',
					'Communication Design',
					'Design Workshop',
					'Editorial Design',
					'Independent Study',
					'Information Design',
					'Interactivity Design',
					'Package Design',
					'Time-Based Design',
					'Typography'
				);
				$mediums = array (
					'Interactive',
					'Package',
					'Print',
					'Video'
				);

				for ($i = 0; $i < 105; $i++) {
					$random_course = $courses[array_rand ($courses)];
					$random_medium = $mediums[array_rand ($mediums)];
					$random_number = rand (1, 5);

					echo '
						<div class="thumbnail" data-course="'.$random_course.'" data-medium="'.$random_medium.'" title="PROJECT NAME&lt;br&gt;Aaron Wright">
							<a href="#">'.rand (1,5).'</a>
						</div>
					';
				}
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
					echo '
						<li><a href="#" data-show-only-medium="'.$medium.'">'.$medium.'</a></li>
					';
				}
			?>
		</ul>

		<h1>filter by course</h1>
		<ul>
			<li><a href="#" data-show-only-course="all">All</a></li>
			<?php
				foreach ($courses as $course)
				{
					echo '
						<li><a href="#" data-show-only-course="'.$course.'">'.$course.'</a></li>
					';
				}
			?>
		</ul>
	</section>
</div>