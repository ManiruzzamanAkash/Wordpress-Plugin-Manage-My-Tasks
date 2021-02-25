<?php
require_once( AK_TASK__PLUGIN_DIR . 'functions/query.php' );

function crudTaskOperation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    
    require_once( AK_TASK__PLUGIN_DIR . 'views/task-list.php' );
}

function createTaskOperation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    
    require_once( AK_TASK__PLUGIN_DIR . 'views/task-create.php' );
}

function completeTaskOperation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    
    require_once( AK_TASK__PLUGIN_DIR . 'views/task-list-done.php' );
}

function allTaskOperation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    
    require_once( AK_TASK__PLUGIN_DIR . 'views/task-list-all.php' );
}
