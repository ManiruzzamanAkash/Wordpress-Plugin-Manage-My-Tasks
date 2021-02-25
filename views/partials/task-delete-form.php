<?php
if (isset($_POST['deleteTask']) && isset($task)) {
    $id = $_POST['id'];
    $response = deleteTask($id);

    if ($response['status']) {
        echo '<script type="text/javascript">
                swal({
                        position: "top-end",
                        title: "'.$response['message'].'",
                        icon: "success",
                        closeOnClickOutside: false,
                        allowOutsideClick: false
                    })
                    .then((success) => {
                        if (success) {
                            window.location.replace("admin.php?page=tasks")
                        }
                    });
         </script>';
        // echo "<script>location.replace('admin.php?page=tasks');</script>";
    } else {
        echo '<script type="text/javascript">
            swal({
                    position: "top-end",
                    icon: "error",
                    title: "'.$response['message'].'",
                    showConfirmButton: false,
                })
        </script>';
    }
}
?>

<form action="" method="post" data-parsley-validate>
<input type="hidden" name="id" value="<?= $task->id ?>">
    <div class="row">
        <div class="col-12">
            <label for="">Are you sure to delete the task ?</label>
            <div class="card card-body p-3">
                <h5><?= $task->title ?></h5>
                <p class="mb-2"> <?= $task->description ?></p>
                <hr>
                <p>
                    Status - <span class="badge badge-info"><?= $task->status ?></span>
                </p>
                <p>
                    Priority - <span class="badge badge-info"><?= $task->priority ?></span>
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