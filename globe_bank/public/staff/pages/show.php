<?php require_once('../../../private/initialize.php'); ?>

<?php

// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0
$page = find_page_by_id($id);
$subject = find_subject_by_id($page['subject_id']);
?>


<?php $subject_title = 'Show Subject'; ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php') ?>">&laquo; Back to List</a>   

    <div class="page show">

    <h1>Subject: <?php echo h($page['menu_name']); ?> </h1>
    <p><span class="font-weight-bold">Subject: </span><?php echo h($subject['menu_name']); ?></p>
    <p><span class="font-weight-bold">Position: </span><?php echo h($page['position']); ?></p>
    <p><span class="font-weight-bold">Visible: </span><?php echo h($page['visible']) == '1' ? 'true' : 'false'; ?></p>
    <p><span class="font-weight-bold">Content: </span><?php echo h($page['content']); ?></p>
    </div>
</div>