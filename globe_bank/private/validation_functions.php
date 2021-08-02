<?php

function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

// has_presence('abcd)
// * validate data presence
// * reverse of is_blank()
//  * I prefer validation names with "has_";
function has_presence($value) {
    return !is_blank($value);
}

// has length_greater_than('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count 
function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
}


// has_length('abcd', ['min' => 3], 'max' => 5)
// * validate string length
// * combines  functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count

function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
        return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
        return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}


// has_inclusion_of (5 , (1, 3, 5, 7, 9))
//  * validate inclusion in a set
function has_inclusion_of($value, $set) {
    return in_array($value, $set);
}

// has_inclusion_of (5 , (1, 3, 5, 7, 9))
//  * validate exclusion from a set
// has_exlusion_of($value, $set) {
//     return !in_array($value, $set);
// }

// has_string('nobody@nowhere.com', '.com')
// * validate inclusion of character(s)
// * strpos returns string start position or false
// * uses !== to prevent position 0 from being considered false
// * strpos is faster than preg_match()
function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
}

function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}

function validate_unique_menu_name($result_set) {
    if(confirm_query($result_set)) {
        return true;
    }
}

function has_unique_page_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name='" . $menu_name . "' ";
    $sql .= "&& id != '" . $current_id . "'";

    $result = mysqli_query($db, $sql);
    $page_count = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $page_count === 0;
}


function validate_subject($subject) {
    $errors = [];

    // menu_name
    if(is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters";
    }

    // position
    // Make sure we are working with an integer
    $position_int = (int) $subject['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }

    if($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

function validate_page($page) {
    $errors = [];
    
    // subject id
    if(is_blank($page['subject_id'])) {
        $errors[] = "Subject cannot be blank";
    }

    // menu name
    $current_id = $page['id'] ?? '0';
    
    if(is_blank($page['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters";
    }

    if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
        $errors[] = 'Page already exists.';
    }


    // position
    // Make sure we are working with an integer
    $position_int = (int) $page['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }

    if($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

?>