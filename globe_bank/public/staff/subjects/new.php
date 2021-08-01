<?php

require_once('../../../private/initialize.php');

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php') ?>">&laquo; Back to List</a>   

    <div class="subjects new">
        <h1>Create Subject</h1>

        <form action="<?php echo url_for('staff/subjects/create.php'); ?>" method="post">
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