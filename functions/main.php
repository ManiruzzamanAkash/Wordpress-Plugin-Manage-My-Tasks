<?php

require_once( AMEAT_AK_TASK__PLUGIN_DIR . 'functions/query.php' );

function AMEAT_crudTaskOperation() {
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    
    require_once( AMEAT_AK_TASK__PLUGIN_DIR . 'views/task-list.php' );
}

function AMEAT_createTaskOperation() {
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    
    require_once( AMEAT_AK_TASK__PLUGIN_DIR . 'views/task-create.php' );
}

function AMEAT_completeTaskOperation() {
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    
    require_once( AMEAT_AK_TASK__PLUGIN_DIR . 'views/task-list-done.php' );
}

function AMEAT_allTaskOperation() {
    global $wpdb;
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    
    require_once( AMEAT_AK_TASK__PLUGIN_DIR . 'views/task-list-all.php' );
}
