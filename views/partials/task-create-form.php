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