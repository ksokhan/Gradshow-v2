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

		<script type="text/javascript" src="js/gallery.js"></script>
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
				<li><a href="#">About</a></li>
				<li><a href="#">Students</a></li>
				<li class="current_page"><a href="#">Gallery</a></li>
				<li><a href="#">Video</a></li>
			</ul>
		</nav>

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
							'interactive',
							'package',
							'print',
							'video'
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
					<li><a href="#" id="sort_randomly">random</a></li>
					<li><a href="#" id="sort_by_medium">medium</a></li>
					<li><a href="#" id="sort_by_course">course</a></li>
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
					<li><a href="#" data-show-only-medium="all">All</a></li>
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

	</body>
</html>