<?php
if (isset($_POST['saveTask'])) {
    try {
        $title = sanitize_text_field($_POST['title']);
        $priority = sanitize_text_field($_POST['priority']);
        $status = 'Pending';
        $description = sanitize_text_field($_POST['description']);

        if (strlen($title) === 0)
            throw new Exception("Please give a valid title");
        $response = createTask($title, $priority, $description, $status);

        if ($response['status']) {
            echo '<script type="text/javascript">
            $(document).ready(function(){
                    swal({
                            position: "top-end",
                            icon: "success",
                            title: "Task has been added !!",
                            closeOnClickOutside: false,
                            allowOutsideClick: false
                        })
                        .then((success) => {
                            if (success) {
                                window.location.replace("admin.php?page=tasks")
                            }
                        });
                });
             </script>';
            // echo "<script>location.replace('admin.php?page=tasks');</script>";
        } else {
            echo '<script type="text/javascript">
                $(document).ready(function(){
                swal({
                        position: "top-end",
                        icon: "error",
                        title: "Something went wrong, Please give task data properly !",
                        showConfirmButton: false
                    })
                });
            </script>';
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">
                $(document).ready(function(){
                swal({
                        position: "top-end",
                        icon: "error",
                        title: "Something went wrong, Please give task data properly !",
                        showConfirmButton: false
                    })
                });
            </script>';
    }
}
?>

<form action="" method="post" data-parsley-validate>
    <div class="row">
        <div class="col-9">
            <label for="">Task Title</label><br />
            <input type="text" id="title" name="title" class="form-control" required />
            <br />
        </div>
        <div class="col-3">
            <label for="">Priority</label><br />
            <select name="priority" id="priority" class="form-control" required>
                <option value="">--Select</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
            <br />
        </div>
    </div>

    <label for="">Task Details</label><br />
    <textarea type="text" id="description" name="description" class="form-control" required></textarea>
    <br />

    <a class="btn btn-secondary" data-dismiss="modal" onclick="location.replace('admin.php?page=tasks')">Cancel</a>
    <button type="submit" id="saveTask" name="saveTask" class="btn btn-primary">Save New</button>
</form>