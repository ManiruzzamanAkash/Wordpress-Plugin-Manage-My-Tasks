<?php

/**
 * CRUD Opearation Table Initialization
 * 
 * Initialize tasks CRUD table
 *
 * @return void
 */
function crudOperationsTable()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . TASK_TABLE_NAME;
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(100) DEFAULT NULL,
        `slug` varchar(100) DEFAULT NULL,
        `description` text(220) DEFAULT NULL,
        `status` enum ('Done','Pending') DEFAULT 'Pending',
        `priority` enum ('High','Medium','Low) DEFAULT 'Low',
        UNIQUE KEY(slug),
        PRIMARY KEY(id)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    ";

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}


