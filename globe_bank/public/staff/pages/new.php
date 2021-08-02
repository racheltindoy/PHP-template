<?php require_once('../../../private/initialize.php'); ?>

<div id="post-params">
<pre>
<?php

if(is_post_request()) {
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';

    $result = insert_page($page);
    if($result === true) {
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $page = [];
    $page['subject_id'] = '';
    $page['menu_name'] = '';
    $page['position'] = '';
    $page['visible'] = '';
    $page['content'] = '';

    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set) + 1;
    mysqli_free_result($page_set);
}

?>
</div>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

<a class="back-link" href="<?php echo url_for('/staff/pages/index.php') ?>">&laquo; Back to List</a>  

<h1>Create Page</h1>

<?php echo display_errors($errors) ?>

<form action="<?php echo url_for('staff/pages/new.php'); ?>" method="post">
    <div class="form-container">
        <label for="menu_name">Menu Name</label>
        <input type="text" id="menu_name" name="menu_name" value="<?php echo h($page['menu_name']); ?>">
    </div>

    <div class="form-container">
        <label for="posiiton">Position</label>
        <select name="position" id="position">
            <?php for($i = 1; $i <= $page_count; $i++ ) { ?>
                <option value="<?php echo $i ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>

        
    </div>
    <div class="form-container">
    <label for="posiiton">Subject</label>
    <select name="subject_id" id="subject_id">
            <?php
            $subjects = find_all_subjects();
            while($subject = mysqli_fetch_assoc($subjects)) {
                // foreach($subjects as $subject) {
                    $subject_name = find_subject_by_id($subject['id']);
                    echo "<option value=\"" . $subject['id'] . "\">";
                    echo $subject_name['menu_name'];
                    echo "</option>";
                }
            
            ?>
     </select>
    </div>

    <div class="form-container">
        <label for="visible">Visible</label>
        <input type="hidden" name="visible" value="0">
        <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == "1") {echo " checked"; } ?>>
    </div>
    
    <input type="submit" name="submit" value="Create Page">

</form>

</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>