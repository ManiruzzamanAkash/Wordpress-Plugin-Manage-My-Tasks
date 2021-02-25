<?php
/**
 * Uninstall and Delete tasks table
 * 
 * Delete tasks CRUD table
 *
 * @return void
 */
function uninstallAndDeleteTables()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $sql = "DROP TABLE `$table_name`";

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
