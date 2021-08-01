
<pre>
<?php

require_once('../../../private/initialize.php');


$pages = find_all_pages2();

// while($page = mysqli_fetch_assoc($pages)) {
//     echo $page['menu_name'];
// }


function has_greater_less_than2($value, $min) {
    $length = strlen($value);
    
    return $length > $min;
}

echo has_greater_less_than2("helloworld", 5);

?>
