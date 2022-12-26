
<!-- Create Modal -->
<div class="modal fade" id="createTaskModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskModalLabel">Create New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php require_once( AMEAT_AK_TASK__PLUGIN_DIR . 'views/partials/task-create-form.php' ); ?>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modals -->
<?php foreach ($tasks as $key => $task) : ?>
<div class="modal fade" id="editTaskModal<?php echo esc_attr( $task->id ); ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php require( AMEAT_AK_TASK__PLUGIN_DIR . "views/partials/task-edit-form.php" ); ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- Delete Modals -->
<?php foreach ($tasks as $key => $task) : ?>
<div class="modal fade" id="deleteTaskModal<?php echo esc_attr( $task->id ); ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaskModalLabel">Delete Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php require( AMEAT_AK_TASK__PLUGIN_DIR . "views/partials/task-delete-form.php" ); ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>