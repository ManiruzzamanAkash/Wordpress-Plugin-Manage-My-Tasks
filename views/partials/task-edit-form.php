<form action="" method="post" data-parsley-validate>
    <input type="hidden" name="id" value="<?php echo  $task->id ?>">
    <div class="row">
        <div class="col-6">
            <label for="">Task Title</label><br />
            <input type="text" id="title" name="title" class="form-control" value="<?php echo  $task->title ?>" required />
            <br />
        </div>
        <div class="col-3">
            <label for="">Priority</label><br />
            <select name="priority" id="priority" class="form-control" required>
                <option value="">--Select</option>
                <option value="High" <?php echo  $task->priority === "High" ? 'selected' : '' ?>>High</option>
                <option value="Medium" <?php echo  $task->priority === "Medium" ? 'selected' : '' ?>>Medium</option>
                <option value="Low" <?php echo  $task->priority === "Low" ? 'selected' : '' ?>>Low</option>
            </select>
            <br />
        </div>
        <div class="col-3">
            <label for="">Status</label><br />
            <select name="status" id="status" class="form-control" required>
                <option value="Pending" <?php echo  $task->status === "Pending" ? 'selected' : '' ?>>Pending</option>
                <option value="Done" <?php echo  $task->status === "Done" ? 'selected' : '' ?>>Done</option>
            </select>
            <br />
        </div>
    </div>

    <label for="">Task Details</label><br />
    <textarea type="text" id="description" name="description" class="form-control" required><?php echo  $task->description ?></textarea>
    <br />

    <a class="btn btn-secondary" data-dismiss="modal" onclick="location.replace('admin.php?page=tasks')">Cancel</a>
    <button type="submit" id="updateTask" name="updateTask" class="btn btn-primary">Save Updates</button>
</form>