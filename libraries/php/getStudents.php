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

<div class="studentImage">
    <a href="/students/view/options/id/<?php echo $user->id ?>">
    <img src="images/student-image-thumbnails/<?php echo ucwords(strtolower($user->first_name)) . "_" . ucwords(strtolower($user->last_name)) ?>01.jpg" class="nohover" border=0>
    <img src="images/student-image-thumbnails/<?php echo ucwords(strtolower($user->first_name)) . "_" . ucwords(strtolower($user->last_name)) ?>02.jpg" class="hover" border=0>
    <h4><?php echo ucwords( strtolower( $user->first_name . ' ' . $user->last_name ) ); ?></h4>
    </a>
</div>
<?php
}
/*
     The strtolower and ucwords part is to be sure
     the full names will all be capitalized.
*/
endforeach; // end the users loop.
?>
