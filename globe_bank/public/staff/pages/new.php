<?php require_once('../../../private/initialize.php'); ?>

<div id="post-params">
<pre>
<?php

$menu_name = '';
$position = '';
$visible = '';



if(is_post_request()) {
    $subject_id = $_POST['subject_id'] ?? '';
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo "Form parameters <br/>";
    echo 'Menu Name:' . $menu_name . '<br/>';
    echo 'Position: ' .  $position . '<br/>';
    echo 'Visible: ' . $visible . '<br/>';
}
?>
</div>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

<a class="back-link" href="<?php echo url_for('/staff/pages/index.php') ?>">&laquo; Back to List</a>  

<h1>Create Page</h1>

<form action="<?php echo url_for('staff/pages/create.php'); ?>" method="post">
    <div class="form-container">
        <label for="menu_name">Menu Name</label>
        <input type="text" id="menu_name" name="menu_name" value="<?php echo h($menu_name); ?>">
    </div>

    <div class="form-container">
        <label for="posiiton">Position</label>
        <select name="position" id="position">
            <option value="1"<?php if($position == "1") {echo " selected"; } ?>>1</option>
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
        <input type="checkbox" name="visible" value="1" <?php if($visible == "1") {echo " checked"; } ?>>
    </div>
    
    <input type="submit" name="submit" value="Create Page">

</form>

</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>