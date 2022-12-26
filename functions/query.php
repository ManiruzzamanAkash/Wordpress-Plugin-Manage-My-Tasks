<?php

/**
 * Get Task Lists
 *
 * @return array tasks list
 */
function AMEAT_getTaskLists($status = '')
{
    $status = trim($status);
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $sql = "";
    if (strlen($status) === 0) {
        $sql = "SELECT * FROM $table_name WHERE 1=%d ORDER BY id DESC";
        $sql_prep = $wpdb->prepare($sql, array(1));
    } else {
        $sql = "SELECT * FROM $table_name WHERE status = %s ORDER BY id DESC";
        $sql_prep = $wpdb->prepare($sql, array($status));
    }
    return $wpdb->get_results($sql_prep);
}

/**
 * Get Task Lists
 *
 * @return array tasks list
 */
function AMEAT_getTaskListsBySearch($search = '', $page_name = 'tasks') {
    $search = trim($search);
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $status = ($page_name === 'tasks') ? 'Pending' : (($page_name === 'tasks-all') ? '' : 'Done');

    $query = "SELECT * FROM $table_name WHERE 1=1 ";

    if ( ! empty( $status ) ) {
	    $query .= " AND `status` = %s ";
    }

    if ( ! empty( $search ) ) {
	    $query .= " AND `title` LIKE %s";
    }

    $query .= " ORDER BY id DESC";

    if ($status === "") {
	    $sql_prep = $wpdb->prepare($query, array('%' . $search . '%'));
    } else {
	    $sql_prep = $wpdb->prepare($query, array($status, '%' . $search . '%'));
    }

    return $wpdb->get_results($sql_prep);
}

/**
 * Count Task List
 *
 * @param string $status
 * @return void
 */
function AMEAT_countTaskLists($status = "")
{
    $status = trim($status);
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $total = 0;
    $query  = "";

    if (strlen($status) === 0) {
        $query = "SELECT COUNT(id) as total FROM $table_name WHERE 1=%d ORDER BY id DESC";
        $sql_prep = $wpdb->prepare($query, array(1));
    } else {
        $query = "SELECT COUNT(id) as total FROM $table_name WHERE status = %s ORDER BY id DESC";
        $sql_prep = $wpdb->prepare($query, array($status));
    }

    $total = $wpdb->get_var($sql_prep);
    if (is_null($total) || $total === "")
        $total = 0;
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
function AMEAT_createTask($title, $priority, $description, $status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $response = [
        'message' => '',
        'status' => false
    ];

    try {
        $wpdb->insert(
            $table_name,
            array(
                'title' => $title,
                'priority' => $priority,
                'description' => $description,
                'status' => $status
            ),
            array('%s', '%s', '%s', '%s')
        );
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
function AMEAT_updateTask($title, $priority, $description, $status, $id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $response = [
        'message' => '',
        'status' => false
    ];

    try {
        $wpdb->update(
            $table_name,
            array(
                'title' => $title,
                'priority' => $priority,
                'description' => $description,
                'status' => $status
            ),
            array('id' => $id),
            array('%s', '%s', '%s', '%s'),
            array('%d'),
        );
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
function AMEAT_updateTaskStatus($id, $status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $response = [
        'message' => '',
        'status' => false
    ];

    try {
        $wpdb->update(
            $table_name,
            array(
                'status' => $status
            ),
            array('id' => $id),
            array('%s'),
            array('%d'),
        );

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
function AMEAT_deleteTask($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $response = [
        'message' => $id,
        'status' => false
    ];

    try {
        $wpdb->delete(
            $table_name,
            array('id' => $id),
            array('%d'),
        );
        $response['message'] = 'Task has been deleted successfully !';
        $response['status'] = true;
    } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
    }

    return $response;
}
