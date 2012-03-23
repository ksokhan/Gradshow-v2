<?php
//require( '../../upload/wp-load.php' );
?>

<?php

function getData() {
    global $wpdb;
    global $id;

    $img['data'] = $wpdb->get_results("
        SELECT ID, post_content, post_title, guid
        FROM $wpdb->posts
        WHERE post_type = 'attachment'
        AND post_author = $id
        AND post_status != 'trash'
    ", ARRAY_A );

    for($i = 0, $l = count($img['data']); $i < $l; $i++)
    {
        $img['meta'][$i] = get_metadata('post', $img['data'][$i]['ID']);
        $img['sizes'][$i] = wp_get_attachment_metadata ($img['data'][$i]['ID']);
    }
    return $img;
}
$id = $_REQUEST['id'];
$imgs = getData();

function imageTitleList() {
    global $id;
    global $imgs;

    foreach ( $imgs['data'] as $index => $value)
    {
        if ($imgs['meta'][$index]['featured'][0] == 'yes') {
            $o .= '<li>';
            $o .= '<a href="./?p=overlay&id=' . $id . '&img=' . $index . '">' . $value['post_title'] . '</a>';
            $o .= '</li>';
        }
    }
    return $o;
}


function drawProfileImages() {
    global $imgs;
    global $id;

    $user = get_userdata( $id );

    foreach ( $imgs['data'] as $index => $value)
    {
        if ($imgs['meta'][$index]['featured'][0] == 'yes') {
            $img_med = $imgs['sizes'][$index]['sizes']['medium'];
            $o .= '<img class="draggable" style="width: ' . $img_med['width'] . '; height: ' . $img_med['height'] . '" src="/upload/files/' . $user->user_nicename . '/' . $img_med['file'] . '" />';
        }
    }
    return $o;
}

function getProjectThumbs($i) {
    global $imgs;
    global $id;

    $user = get_userdata( $id );
    $project = $imgs['meta'][$i]['project'][0];

    foreach ( $imgs['data'] as $index => $value)
    {
        if ($imgs['meta'][$index]['project'][0] == $project) {
            $img_med = $imgs['sizes'][$index]['sizes']['thumbnail'];
            $o .= '<a href="/upload/files/' . $user->user_nicename . '/' . $imgs['sizes'][$index]['sizes']['large']['file'] . '" class="olthumblink"><img class="olthumbnail" style="width: ' . $img_med['width'] . '; height: ' . $img_med['height'] . '" src="/upload/files/' . $user->user_nicename . '/' . $img_med['file'] . '" /></a>';
        }
    }
    return $o;
}

// this echos out the whole thing:
// echo '<pre>'.print_r($imgs, true).'</pre>';



?>