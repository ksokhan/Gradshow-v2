<?php

function getData() {
	global $wpdb;
	global $id;


	if ($id == "gallery") {
		$query = "
			SELECT ID, post_title, post_author
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
			AND post_status != 'trash'";
	} else {
		$query = "
			SELECT ID, post_content, post_title, guid
			FROM $wpdb->posts
			WHERE post_type = 'attachment'
			AND post_author = $id
			AND post_status != 'trash'";
	}


	$img['data'] = $wpdb->get_results($query, ARRAY_A );

	for($i = 0, $l = count($img['data']); $i < $l; $i++)
	{
		$img['meta'][$i] = get_metadata('post', $img['data'][$i]['ID']);
		$img['sizes'][$i] = wp_get_attachment_metadata ($img['data'][$i]['ID']);

		if ($id == "gallery") {
			$img['author'][$i] = get_userdata( $img['data'][$i]['post_author'] );
		}
	}
	return $img;
}

$imgs = getData();
//print_r($imgs);

function imageTitleList() {
	global $id;
	global $imgs;

	foreach ( $imgs['data'] as $index => $value)
	{
		if ($imgs['meta'][$index]['featured'][0] == 'yes') {

			$o .= '
				<li>
					<a class="overlayLink" href="/partial/students/view/overlay/options/id/' . $id . '/image/' . $index . '" data-url="/partial/students/view/overlay/options/id/' . $id . '/image/' . $index . '">' . $value['post_title'] . '</a>
				</li>
			';
		}
	}
	return $o;
}

function drawAllImages() {
	global $id;
	global $imgs;
	$course_replace = array('advanced','2','1','3','4');

	foreach ( $imgs['data'] as $index => $value)
	{
		if ($imgs['meta'][$index]['featured'][0] == 'yes' && !empty($imgs['sizes'][$index]['sizes']['thumbnail'])) {

			$img_thumb = $imgs['sizes'][$index]['sizes']['thumbnail'];
			$course = trim( str_replace($course_replace, '', $imgs['meta'][$index]['course'][0]) , '-');

			$o .= '
				<div class="thumbnail" data-course="'. $course .'" data-medium="'. $imgs['meta'][$index]['category'][0] .'" title="' . str_replace('"', '&quot;', $imgs['data'][$index]['post_title']) . '&lt;br&gt;' . $imgs['author'][$index]->first_name . ' ' . $imgs['author'][$index]->last_name . '">
					<a href="/students/view/options/action/overlay/id/' . $imgs['author'][$index]->ID . '/image/' . $imgs['data'][$index]['ID'] . '"><img data-src="/upload/files/' . $imgs['author'][$index]->user_nicename . '/' . $img_thumb['file'] . '"></a>
				</div>
			';
		}
	}
	return $o;
}


function drawUserImages() {
	global $imgs;
	global $id;
	global $page_options;

	$user = get_userdata( $id );

	foreach ( $imgs['data'] as $index => $value)
	{
		if ($imgs['meta'][$index]['featured'][0] == 'yes') {

			if (!empty($page_options['image']) && $page_options['image'] == $imgs['data'][$index]['ID'])
			{
				$active = "active";
			}
			$img_med = null;
			foreach ($imgs['sizes'][$index]['sizes'] as $size => $val)
			{
				if ($size == 'medium') $img_med = $val;
			}
			$o .= '<img class="poster ' . $active . '" style="width: ' . $img_med['width'] . '; height: ' . $img_med['height'] . '" src="/upload/files/' . $user->user_nicename . '/' . $img_med['file'] . '" data-course="" data-url="/partial/students/view/overlay/options/id/' . $id . '/image/' . $index . '" data-medium="" title="Project Title" />';

			$active = ""; // reset active
		}
	}
	return $o;
}

function overlayProjectThumbs($i) {
	global $imgs;
	global $id;

	$user = get_userdata( $id );
	$project = $imgs['meta'][$i]['project'][0];
	$thumbs = array ();

	foreach ( $imgs['data'] as $index => $value)
	{
		if ($imgs['meta'][$index]['project'][0] == $project) {
			$img_med = $imgs['sizes'][$index]['sizes']['thumbnail'];

			$largeImage = !empty ($imgs['sizes'][$index]['sizes']['large']) ? $imgs['sizes'][$index]['sizes']['large'] : $imgs['sizes'][$index]['sizes']['medium'];

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

			$thumb_html	= '';
			if (!empty($imgs['meta'][$index]['link'][0]) && preg_match('/[0-9]+\/?$/', $imgs['meta'][$index]['link'][0]))
			{
				$thumb_html .= '
					<a href="#" class="video-link" data-video-url="'.$imgs['meta'][$index]['link'][0].'" data-position="'.$imgs['meta'][$index]['supporting'][0].'">
						<span>
							<img src="/images/overlay.video-thumbnail.png" />
						</span>
					</a>
				';
			}

			$thumb_html .= '
				<a href="/upload/files/'.$user->user_nicename.'/'.$largeImage['file'].'" class="olthumblink" data-enlarged-width="'.$w.'" data-enlarged-height="'.$h.'" data-featured="'.$imgs['meta'][$index]['featured'][0].'" data-position="'.$imgs['meta'][$index]['supporting'][0].'">
					<span>
						<img class="olthumbnail" style="width: '.$img_med['width'].'; height: '.$img_med['height'].'" src="/upload/files/'.$user->user_nicename.'/'.$img_med['file'].'" />
					</span>
				</a>
			';

			$thumbs[] = $thumb_html;
		}
	}
	return implode ('', $thumbs);
}

// this echos out the whole thing:
// echo '<pre>'.print_r($imgs, true).'</pre>';



?>