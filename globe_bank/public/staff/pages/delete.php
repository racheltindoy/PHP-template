<?php

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];
$page = find_page_by_id($id);

if(is_post_request()) {
    delete_page($id);
    redirect_to(url_for('staff/pages/index.php'));
}

?>

<?php $page_title = 'Delete Page' ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">
    <a href="<?php echo url_for('staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="page delete">
        <h1>Delete Page</h1>
        <p>Are you sure you want to delete this page?</p>
        <p class="item"><?php echo h($page['menu_name']); ?></p>

        <form action="<?php echo url_for('/staff/pages/delete.php?id=' . $id); ?>" method="post">
            <input type="submit" name="delete" value="Delete Page">
        </form>
    </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php') ?>