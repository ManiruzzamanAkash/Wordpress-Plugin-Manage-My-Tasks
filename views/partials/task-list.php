<?php

/**
 * Searching
 */
if (isset($_POST['search'])) {
    $search = sanitize_text_field($_POST['s']);
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $page_name = explode('=', explode('page', explode('?', $url)[1])[1])[1];
    $tasks = AMEAT_getTaskListsBySearch($search, $page_name);
}
?>
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
                <tr class="<?php echo esc_attr( $task->status === "Pending" ? 'task-pending' : 'task-done' ); ?>">
                    <td width="5%"><?php echo esc_attr( $key + 1 ); ?></td>
                    <td width="20%"><?php echo esc_attr( $task->title ); ?></td>
                    <td width="10%"><?php echo esc_attr( $task->priority ); ?></td>
                    <td width="10%">
                        <?php if ( "Pending" === $task->status ) : ?>
                            <span class="badge badge-warning"> Pending </span>
                        <?php endif; ?>

                        <?php if ( "Done" === $task->status ) : ?>
                            <span class="badge badge-success"> Done </span>
                        <?php endif; ?>
                    </td>
                    <td width="25%"><?php echo wp_kses_post( $task->description ); ?></td>
                    <td width="10%">
                        <?php if ( "Pending" === $task->status ) : ?>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="mark_as_complete_status" value="Done">
                                <input type="hidden" name="mark_as_complete_id" value="<?php echo esc_attr( $task->id ); ?>">
                                <button type="submit" class="btn btn-warning btn-sm" name="submit_mark_complete" title="Mark As Complete"><i class="fa fa-check"></i></button>
                            </form>
                        <?php endif; ?>

                        <?php if ($task->status === "Done") : ?>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="mark_as_pending_status" value="Pending">
                                <input type="hidden" name="mark_as_pending_id" value="<?php echo esc_attr( $task->id ); ?>">
                                <button type="submit" class="btn btn-info btn-sm" name="submit_mark_pending" title="Mark As Pending"><i class="fa fa-refresh"></i></button>
                            </form>
                        <?php endif; ?>

                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#editTaskModal<?php echo esc_attr( $task->id ); ?>" title="Task Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTaskModal<?php echo esc_attr( $task->id ); ?>" title="Task Delete"><i class="fa fa-trash"></i></a>
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