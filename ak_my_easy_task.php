<?php

/**
 * @package Ak_My_Easy_Tasks
 * @version 1.0.0
 */

/*
Plugin Name: Manage My Tasks Now
Plugin URI: http://wordpress.org/plugins/ak-manage-my-easy-tasks/
Description: Plugin which can create task for yourself and make your life easier...
Author: Maniruzzaman Akash
Version: 1.0.0
Author URI: https://akash.devsenv.com
*/

/**
 * Defined Data
 */
define( 'AK_TASK__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TASK_TABLE_NAME', "AKASH_CRUD_tblTasks" );

/**
 * Calls when plugin is activated
 */
register_activation_hook(__FILE__, 'crudOperationsTable');


/**
 * Calls when plugin is deactivated
 */
register_deactivation_hook(__FILE__, 'uninstallAndDeleteTables');


// Initializes Function
require_once( AK_TASK__PLUGIN_DIR . 'functions/init.php' );
require_once( AK_TASK__PLUGIN_DIR . 'functions/uninstall.php' );
require_once( AK_TASK__PLUGIN_DIR . 'functions/main.php' );


// Create CRUD Pages for Admin
add_action('admin_menu', 'addAdminPageContent');


function addAdminPageContent()
{
    add_menu_page( 'Task Management', 'My Tasks', 'manage_options', 'tasks', 'crudTaskOperation', 'dashicons-admin-page');
    add_submenu_page( 'tasks', 'Create Task', 'Create Task', 'manage_options', 'tasks-create', 'createTaskOperation', 3);
    add_submenu_page( 'tasks', 'Completed Task', 'Completed Task', 'manage_options', 'tasks-complete', 'completeTaskOperation', 2);
    add_submenu_page( 'tasks', 'All Task', 'All Task', 'manage_options', 'tasks-all', 'allTaskOperation', 1);
}

