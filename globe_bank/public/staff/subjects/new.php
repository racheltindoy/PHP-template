<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {
    $subject = [];
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'];
    
    $result = insert_subject($subject);

    if($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('staff/subjects/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    // display the blank form;
}

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php') ?>">&laquo; Back to List</a>   

    <div class="subjects new">
        <h1>Create Subject</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('staff/subjects/new.php'); ?>" method="post">
            <div class="form-container">
                <label for="menu_name">Menu Name: </label>
                <input type="text" id="menu_name" name="menu_name" placeholder="" value="">
            </div>

            <div>
                <label for="position">Position: </label>
                <select name="position" id="position">
                    <option value="1">1</option>
                </select>
            </div>

            <div>
                <label for="visible">Visible</label>
                <input type="hidden" name="visible" value="0">
                <input type="checkbox" name="visible" value="1">
            </div>

            <div>
                <input type="submit"  value="Create Subject">
            </div>
            
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>