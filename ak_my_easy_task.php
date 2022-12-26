<?php
/*
Plugin Name:        Manage My Tasks Now
Description:        Task Management Plugin which can create task for yourself and make your life easier with every perspective of life.
Plugin URI:         http://wordpress.org/plugins/ameat-ak-manage-my-easy-tasks/
Version:            1.0.0
Requires at least:  5.1
Requires PHP:       5.6
Tested up to:       6.1
License:            GPL-2.0-or-later
License URI:        https://www.gnu.org/licenses/gpl-2.0.html
Author:             Maniruzzaman Akash<manirujjamanakash@gmail.com>
Author URI:         https://akash.devsenv.com
Text Domain:        ameat-ak-task
*/

/**
 * Defined Data.
 */
define('AMEAT_AK_TASK__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('AMEAT_TASK_TABLE_NAME', "AMEAT_tblTasks");

/**
 * Calls when plugin is activated.
 */
register_activation_hook(__FILE__, 'AMEAT_crudOperationsTable');

/**
 * Calls when plugin is deactivated.
 */
register_deactivation_hook(__FILE__, 'AMEAT_uninstallAndDeleteTables');


// Initializes Function.
require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'functions/init.php');
require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'functions/uninstall.php');
require_once(AMEAT_AK_TASK__PLUGIN_DIR . 'functions/main.php');

// Create CRUD Pages for Admin.
add_action('admin_menu', 'AMEAT_addAdminPageContent');

function AMEAT_addAdminPageContent() {
    add_menu_page('Task Management', 'My Tasks', 'manage_options', 'tasks', 'AMEAT_crudTaskOperation', 'dashicons-admin-page');
    add_submenu_page('tasks', 'Create Task', 'Create Task', 'manage_options', 'tasks-create', 'AMEAT_createTaskOperation', 3);
    add_submenu_page('tasks', 'Completed Task', 'Completed Task', 'manage_options', 'tasks-complete', 'AMEAT_completeTaskOperation', 2);
    add_submenu_page('tasks', 'All Task', 'All Task', 'manage_options', 'tasks-all', 'AMEAT_allTaskOperation', 1);
}

// Add Styles & JS Action.
add_action('admin_init', 'AMEAT_admin_js_css_init');

/**
 * Init CSS and JS.
 *
 * @return void
 */
function AMEAT_admin_js_css_init() {
    wp_register_style('AMEAT_bootstrap_styles', plugins_url('/assets/css/bootstrap.min.css', __FILE__));
    wp_register_style('AMEAT_parsley_styles', plugins_url('/assets/css/parsley.css', __FILE__));
    wp_register_style('AMEAT_font_awesome_styles', plugins_url('/assets/css/fonts/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_register_style('AMEAT_main_styles', plugins_url('/assets/css/style.css', __FILE__));
    add_action('admin_print_styles', 'AMEAT_admin_styles');

    wp_register_script('AMEAT_sweetalert_script', plugins_url('/assets/js/sweetalert.min.js', __FILE__));
    wp_register_script('AMEAT_popper_script', plugins_url('/assets/js/popper.min.js', __FILE__));
    wp_register_script('AMEAT_bootstrap_script', plugins_url('/assets/js/bootstrap.min.js', __FILE__));
    wp_register_script('AMEAT_parsley_script', plugins_url('/assets/js/parsley.min.js', __FILE__));
    add_action('admin_print_scripts', 'AMEAT_admin_scripts');

    /**
     * Init CSS.
     *
     * @return void
     */
    function AMEAT_admin_styles() {
        wp_enqueue_style('AMEAT_bootstrap_styles');
        wp_enqueue_style('AMEAT_parsley_styles');
        wp_enqueue_style('AMEAT_font_awesome_styles');
        wp_enqueue_style('AMEAT_main_styles');
    }

    /**
     * Init JS.
     *
     * @return void
     */
    function AMEAT_admin_scripts() {
        wp_enqueue_script('AMEAT_sweetalert_script');
        wp_enqueue_script('AMEAT_popper_script');
        wp_enqueue_script('AMEAT_bootstrap_script');
        wp_enqueue_script('AMEAT_parsley_script');
    }
}
