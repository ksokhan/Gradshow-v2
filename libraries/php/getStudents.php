<?php

/*
    First we set how we'll want to sort the user list.
    You could sort them by:
    ------------------------
    * ID - User ID number.
    * user_login - User Login name.
    * user_nicename - User Nice name ( nice version of login name ).
    * user_email - User Email Address.
    * user_url - User Website URL.
    * user_registered - User Registration date.
*/
$szSort = "user_nicename";
/*
    Now we build the custom query to get the ID of the users.
*/
$aUsersID = $wpdb->get_col( $wpdb->prepare(
    "SELECT $wpdb->users.ID FROM $wpdb->users ORDER BY %s ASC"
    , $szSort ));
/*
    Once we have the IDs we loop through them with a Foreach statement.
*/
foreach ( $aUsersID as $iUserID ) :
/*
    We use get_userdata() function with each ID.
*/
$user = get_userdata( $iUserID );
/*
    Here we finally print the details wanted.
    Check the description of the database tables linked above to see
    all the fields you can retrieve.
    To echo a property simply call it with $user->name_of_the_column.
    In this example I print the first and last name.
*/
if ($user->last_name != "") {

echo '
    <div class="thumbnail student" data-first-name="'.$user->first_name.'" data-last-name="'.$user->last_name.'" title="'.$user->first_name.' '.$user->last_name.'">
        <a href="/students/view/options/id/' . $user->id . '">
            <img src="images/student-image-thumbnails/' . ucwords(strtolower($user->first_name)) . "_" . ucwords(strtolower($user->last_name)) . '01.jpg" class="">
            <img src="images/student-image-thumbnails/' . ucwords(strtolower($user->first_name)) . "_" . ucwords(strtolower($user->last_name)) . '02.jpg" class="hover">
        </a>

        <div class="caption">
            '.$user->first_name.' '.$user->last_name.'
        </div>
    </div>
';

}
/*
     The strtolower and ucwords part is to be sure
     the full names will all be capitalized.
*/
endforeach; // end the users loop.
?>
