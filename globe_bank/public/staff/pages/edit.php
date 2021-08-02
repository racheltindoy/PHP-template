<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {
    $page['id'] = $id;
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = update_page($page);
    if($result === true) {
        redirect_to(url_for('/staff/pages/show.php?id=') . $id);
    } else {
        $errors = $result;
    }
    
}


$page = find_page_by_id($id);
$pages_by_subject_id = find_pages_by_subject_id($page['subject_id']);
$pages_by_subject_id_count = mysqli_num_rows($pages_by_subject_id);
$subjects = find_all_subjects();


?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>


<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>   

    <div class="pages new">
        <h1>Edit Page</h1>

        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . $id); ?>" method="post">
            <div class="form_container">
                <label for="menu_name">Menu Name: </label>
                <input type="text" id="menu_name" name="menu_name" placeholder="" value="<?php echo h($page['menu_name']); ?>">
            </div>
            
            <div>
                <label for="subject_id">Subject: </label>
                <select name="subject_id" id="subject_id">
                <?php
                    foreach($subjects as $subject) {
                        echo "<option value='" . $subject['id'] . "'";
                        if($page['subject_id'] == $subject['id']) {
                            echo " selected";
                        }
                        echo ">" . h($subject['menu_name']);
                        echo "</option>";
                    }
                ?>
                </select>
            </div>

            <div>
                <label for="position">Position: </label>
                <select name="position" id="position">
                <?php
                    for($i=1; $i<=$pages_by_subject_id_count; $i++) {
                        echo "<option value=\"" . $i . "\"";                   
                        if($page['position'] == $i) {
                            echo " selected";
                        }
                        echo ">" . $i . "</option>";
                    }
                ?>
                </select>
            </div>

            <div>
                <label for="visible">Visible</label>
                <input type="hidden" name="visible" value="0">
                <input type="checkbox" name="visible" value="1" <?php if($page['visible'] == "1") {echo " checked"; } ?>>
            </div>
            <div>
                <textarea name="content" id="" cols="30" rows="10" value="<?php echo h($page['content']); ?>"></textarea>
            </div>

            <div>
                <input type="submit" name="submit"  value="Edit Page">
            </div>
            
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>