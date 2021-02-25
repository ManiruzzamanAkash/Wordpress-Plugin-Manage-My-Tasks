<?php

/**
 * Get Task Lists
 *
 * @return array tasks list
 */
function getTaskLists($status = '')
{
    $status = trim($status);
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $query = "";
    if (strlen($status) === 0)
        $query = "SELECT * FROM $table_name ORDER BY id DESC";
    else
        $query = "SELECT * FROM $table_name WHERE status = '$status' ORDER BY id DESC";

    return $wpdb->get_results($query);
}

/**
 * Get Task Lists
 *
 * @return array tasks list
 */
function getTaskListsBySearch($search = '', $page_name = 'tasks')
{
    $search = trim($search);
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $status = ($page_name === 'tasks') ? 'Pending' : (($page_name === 'tasks-all') ? '' : 'Done');
    
    $query = "SELECT * FROM $table_name WHERE 1=1 ";

    if ($status !== "") 
        $query .= " AND status='$status' ";

    if (strlen($search) >= 0)
        $query .= " AND title LIKE '%$search%'";

    $query .= "ORDER BY id DESC";
    return $wpdb->get_results($query);
}

/**
 * Count Task List
 *
 * @param string $status
 * @return void
 */
function countTaskLists($status = "")
{
    $status = trim($status);
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $total = 0;
    if (strlen($status) === 0)
        $total = $wpdb->get_results("SELECT COUNT(id) as total FROM $table_name ORDER BY id DESC");
    else
        $total = $wpdb->get_results("SELECT COUNT(id) as total FROM $table_name WHERE status = '$status' ORDER BY id DESC");
    if (count($total) > 0)
        return $total[0]->total;
    return $total;
}


/**
 * Create New Task
 *
 * @param string $title
 * @param string $priority
 * @param string $description
 * @param string $status
 * @return Object Task Create Object
 */
function createTask($title, $priority, $description, $status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $response = [
        'message' => '',
        'status' => false
    ];

    try {
        $wpdb->query("INSERT INTO $table_name(title, priority, description, status) VALUES('$title','$priority','$description','$status')");
        $response['message'] = 'Task Created Successfully !';
        $response['status'] = true;
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }

    return $response;
}


/**
 * Update Task
 *
 * @param string $title
 * @param string $priority
 * @param string $description
 * @param string $status
 * @param int $id Task Updated ID
 * @return Object Task Updated Object
 */
function updateTask($title, $priority, $description, $status, $id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $response = [
        'message' => '',
        'status' => false
    ];

    try {
        $query = "UPDATE $table_name SET title='$title', priority='$priority', description='$description', status='$status' WHERE id = $id LIMIT 1";
        $wpdb->query($query);
        $response['message'] = 'Task Updated Successfully !';
        $response['status'] = true;
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }

    return $response;
}

/**
 * Update Task Status
 *
 * @param int $id
 * @param string $status
 * @return void
 */
function updateTaskStatus($id, $status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $response = [
        'message' => '',
        'status' => false
    ];

    try {
        $query = "UPDATE $table_name SET status='$status' WHERE id = $id LIMIT 1";
        $wpdb->query($query);
        $response['message'] = 'Task Updated Successfully !';
        $response['status'] = true;
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }

    return $response;
}

/**
 * Delete Task
 *
 * @param int $id
 * @return Object After deletion response
 */
function deleteTask($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $response = [
        'message' => $id,
        'status' => false
    ];

    try {
        $wpdb->query("DELETE FROM $table_name WHERE id=$id LIMIT 1");
        $response['message'] = 'Task has been deleted successfully !';
        $response['status'] = true;
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }

    return $response;
}
