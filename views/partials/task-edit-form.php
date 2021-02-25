<?php
if (isset($_POST['updateTask']) && isset($task)) {
    $title = sanitize_text_field($_POST['title']);
    $priority = sanitize_text_field($_POST['priority']);
    $status = sanitize_text_field($_POST['status']);
    $description = sanitize_text_field($_POST['description']);
    $id = $_POST['id'];
    if (strlen($title) === 0)
        throw new Exception("Please give a valid title");

    $response = updateTask($title, $priority, $description, $status, $id);

    if ($response['status']) {
        echo '<script type="text/javascript">
                    swal({
                            position: "top-end",
                            title: "Task has been updated !!",
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
                        title: "Something went wrong, Please give task data properly !",
                        showConfirmButton: false,
                    })
            </script>';
    }
}
?>

<form action="" method="post" data-parsley-validate>
    <input type="hidden" name="id" value="<?= $task->id ?>">
    <div class="row">
        <div class="col-6">
            <label for="">Task Title</label><br />
            <input type="text" id="title" name="title" class="form-control" value="<?= $task->title ?>" required />
            <br />
        </div>
        <div class="col-3">
            <label for="">Priority</label><br />
            <select name="priority" id="priority" class="form-control" required>
                <option value="">--Select</option>
                <option value="High" <?= $task->priority === "High" ? 'selected' : '' ?>>High</option>
                <option value="Medium" <?= $task->priority === "Medium" ? 'selected' : '' ?>>Medium</option>
                <option value="Low" <?= $task->priority === "Low" ? 'selected' : '' ?>>Low</option>
            </select>
            <br />
        </div>
        <div class="col-3">
            <label for="">Status</label><br />
            <select name="status" id="status" class="form-control" required>
                <option value="Pending" <?= $task->status === "Pending" ? 'selected' : '' ?>>Pending</option>
                <option value="Done" <?= $task->status === "Done" ? 'selected' : '' ?>>Done</option>
            </select>
            <br />
        </div>
    </div>

    <label for="">Task Details</label><br />
    <textarea type="text" id="description" name="description" class="form-control" required><?= $task->description ?></textarea>
    <br />

    <a class="btn btn-secondary" data-dismiss="modal" onclick="location.replace('admin.php?page=tasks')">Cancel</a>
    <button type="submit" id="updateTask" name="updateTask" class="btn btn-primary">Save Updates</button>
</form>