<?php
/**
 * Trigger this file on plugin uninstall
 *
 * @package SmartdeliveryPlugin
 */

if (!defined("WP_UNINSTALL_PLUGIN")) {
  die();
}

// Clear Database data

// $products = get_post(["post_type" => "contact", "numberposts" => -1]);
// foreach ($products as $product) {
//   wp_delete_post($product->ID, true);
// }

// Access database via SQL
global $wpdb;

// $wpdb->query("DELETE FROM wp_posts WHERE post_type='contact'");
// $wpdb->query(
//   "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)"
// );
$wpdb->query(
  "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)"
);
