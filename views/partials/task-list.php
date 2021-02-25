<?php
if (isset($_POST['submit_mark_complete'])) {
    $id = sanitize_text_field($_POST['mark_as_complete_id']);
    $status = sanitize_text_field($_POST['mark_as_complete_status']);
    $response = updateTaskStatus($id, $status);
    if ($response['status']) {
        echo '<script type="text/javascript">
                window.location.replace("admin.php?page=tasks")
         </script>';
    }
}

if (isset($_POST['submit_mark_pending'])) {
    $id = sanitize_text_field($_POST['mark_as_pending_id']);
    $status = sanitize_text_field($_POST['mark_as_pending_status']);
    $response = updateTaskStatus($id, $status);
    if ($response['status']) {
        echo '<script type="text/javascript">
                window.location.replace("admin.php?page=tasks")
         </script>';
    }
}
?>
<style>
    tr.task-done td {
        background: #fbe6e8;
        border-top: 1px solid #fff;
    }
</style>

<?php if (count($tasks) > 0) : ?>
    <table class="wp-list-table widefat fixed striped table-view-list pages">
        <thead>
            <tr>
                <th width="5%">Sl</th>
                <th width="20%">Title</th>
                <th width="10%">Priority</th>
                <th width="10%">Status</th>
                <th width="25%">Details</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $key => $task) : ?>
                <tr class="<?= $task->status === "Pending" ? 'task-pending' : 'task-done' ?>">
                    <td width="5%"><?= $key + 1 ?></td>
                    <td width="20%"><?= $task->title ?></td>
                    <td width="10%"><?= $task->priority ?></td>
                    <td width="10%">
                        <?php if ($task->status === "Pending") : ?>
                            <span class="badge badge-warning"> Pending </span>
                        <?php endif; ?>

                        <?php if ($task->status === "Done") : ?>
                            <span class="badge badge-success"> Done </span>
                        <?php endif; ?>
                    </td>
                    <td width="25%"><?= $task->description ?></td>
                    <td width="10%">
                        <?php if ($task->status === "Pending") : ?>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="mark_as_complete_status" value="Done">
                                <input type="hidden" name="mark_as_complete_id" value="<?= $task->id ?>">
                                <button type="submit" class="btn btn-warning btn-sm" name="submit_mark_complete" title="Mark As Complete"><i class="fa fa-check"></i></button>
                            </form>
                        <?php endif; ?>

                        <?php if ($task->status === "Done") : ?>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="mark_as_pending_status" value="Pending">
                                <input type="hidden" name="mark_as_pending_id" value="<?= $task->id ?>">
                                <button type="submit" class="btn btn-info btn-sm" name="submit_mark_pending" title="Mark As Pending"><i class="fa fa-refresh"></i></button>
                            </form>
                        <?php endif; ?>

                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#editTaskModal<?= $task->id ?>" title="Task Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTaskModal<?= $task->id ?>" title="Task Delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php if (count($tasks) === 0) : ?>
    <div class="alert alert-warning mt-5">
        Sorry!! No task added in this category !
        <div class="mt-2">
            <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#createTaskModal">
                <i class="fa fa-plus-circle"></i> Create New Task
            </button>
        </div>
    </div>

<?php endif; ?>