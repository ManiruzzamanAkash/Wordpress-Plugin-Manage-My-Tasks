<?php

/**
 * CRUD Operation Table Initialization.
 * 
 * Initialize tasks CRUD table.
 *
 * @return void
 */
function AMEAT_crudOperationsTable()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . AMEAT_TASK_TABLE_NAME;
    $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(100) DEFAULT NULL,
        `description` text(220) DEFAULT NULL,
        `status` enum ('Done','Pending') DEFAULT 'Pending',
        `priority` enum ('High','Medium','Low') DEFAULT 'Low',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY(id)
        ) $charset_collate;
    ";

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}


