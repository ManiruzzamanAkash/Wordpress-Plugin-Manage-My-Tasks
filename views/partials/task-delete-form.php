<form action="" method="post" data-parsley-validate>
    <input type="hidden" name="id" value="<?php echo  $task->id ?>">
    <div class="row">
        <div class="col-12">
            <label for="">Are you sure to delete the task ?</label>
            <div class="card card-body p-3">
                <h5><?php echo  $task->title ?></h5>
                <p class="mb-2"> <?php echo  $task->description ?></p>
                <hr>
                <p>
                    Status - <span class="badge badge-info"><?php echo  $task->status ?></span>
                </p>
                <p>
                    Priority - <span class="badge badge-info"><?php echo  $task->priority ?></span>
                </p>
            </div>
        </div>
    </div>

    <br />

    <a class="btn btn-secondary" data-dismiss="modal" onclick="location.replace('admin.php?page=tasks')">Cancel</a>
    <button type="submit" id="deleteTask" name="deleteTask" class="btn btn-danger">
        <i class="fa fa-trash"></i> Confirm Delete
    </button>
</form>