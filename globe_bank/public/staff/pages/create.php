<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {
    $subject_id = $_POST['subject_id'] ?? '';
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';
    
    echo $subject_id . "<br>";
    echo $menu_name . "<br>";
    echo $position . "<br>";
    echo $visible . "<br>";

    insert_page($subject_id, $menu_name, $position, $visible);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
} else {
    redirect_to(url_for('/staff/pages/index.php'));
}

?>