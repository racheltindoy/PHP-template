<?php require_once('../../../private/initialize.php'); ?>

<?php

// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$subject = find_subject_by_id($id);
?>


<?php $subject_title = 'Show Subject'; ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php') ?>">&laquo; Back to List</a>   

    <div class="subject show">

    <h1>Subject: <?php echo h($subject['menu_name']); ?> </h1>
    <p><span class="font-weight-bold">Position: </span><?php echo h($subject['position']); ?></p>
    <p><span class="font-weight-bold">Visible: </span><?php echo h($subject['visible']) == '1' ? 'true' : 'false'; ?></p>
    </div>
</div>