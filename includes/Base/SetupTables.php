<?php


/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;


class SetupTables
{
    public static function smart_create_tables()
    {

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $version         = (int) get_site_option('smart_db_version');
        $success = false;
        if ($version < 1) {
            $accounts = "CREATE TABLE `{$wpdb->base_prefix}shipping_accounts` (
            account_id      bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            first_name      varchar(50) NOT NULL,
            last_name       varchar(50) NOT NULL,
            email           varchar(50) NOT NULL UNIQUE,
            phone	        varchar(20) NOT NULL UNIQUE,
            gender          varchar(1) NOT NULL,
            agreement       tinyint NOT NULL DEFAULT 1,
            created_at      datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY     (account_id)
            ) $charset_collate; ";

            $quotations = "CREATE TABLE `{$wpdb->base_prefix}user_quotations` (
            id      bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            first_name      varchar(50) NOT NULL,
            last_name       varchar(50) NOT NULL,
            email           varchar(50) NOT NULL UNIQUE,
            phone	        varchar(20) NOT NULL UNIQUE,
            service         json NOT NULL,
            products        json,
            other_info      blob,
            created_at      datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY     (id)
            ) $charset_collate;";


            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta([$accounts, $quotations]);
            $success = empty($wpdb->last_error);

            update_site_option('smart_db_version', 2);
        }

        return $success;
    }
}
