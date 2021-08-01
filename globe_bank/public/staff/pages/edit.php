<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$menu_name = '';
$position = '';
$visible = '';
$content = '';

$page = find_page_by_id($id);
$pages_by_subject_id = find_pages_by_subject_id($page['subject_id']);
$pages_by_subject_id_count = mysqli_num_rows($pages_by_subject_id);

$subjects = find_all_subjects();


if(is_post_request()) {
    $subject_id = $_POST['subject_id'] ?? '';
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'];
    $content = $_POST['content'] ?? '';

    update_page($id, $subject_id, $menu_name, $position, $visible, $content);

    echo $subject_id = $_POST['subject_id'] ?? '';
    echo $menu_name = $_POST['menu_name'] ?? '';
    echo $position = $_POST['position'] ?? '';
    echo $visible = $_POST['visible'];
    echo  $content = $_POST['content'] ?? '';
    redirect_to(url_for('/staff/pages/show.php?id=') . $id);
}

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php

    // while($page_by_subject_id = mysqli_fetch_assoc($pages_by_subject_id)) {
    //     echo $page_by_subject_id['menu_name'];
    // }

?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>   

    <div class="pages new">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
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