<?php $tasks = AMEAT_getTaskLists('Pending'); ?>

<div class="wrap akash-crud-task-area">
    <h1 class="wp-heading-inline">Tasks</h1>
    <button class="page-title-action" data-toggle="modal" data-target="#createTaskModal">Add New</button>

    <?php require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'views/partials/count-tasks.php'); ?>
    <?php require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'views/partials/task-list.php'); ?>
</div>

<?php require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'views/partials/task-modals.php'); ?>
<?php require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'functions/actions.php'); ?>