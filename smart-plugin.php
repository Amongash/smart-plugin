<?php
/**
 * @package SmartdeliveryPlugin
 */
/*
Plugin Name: Smartdelivery Plugin
Description: Custom forms for Smartdelivery
Version: 1.0.0
Author: Amos Kamari 
Author URI: http://github.com/amongash
License: None
*/

defined("ABSPATH") or die();
if (!class_exists("SmartdeliveryPlugin")) {
  class SmartdeliveryPlugin
  {
    public $plugin_name;

    function __construct()
    {
      $this->plugin_name = plugin_basename(__FILE__);
    }

    function register_admin()
    {
      add_action("admin_enqueue_scripts", [$this, "enqueue_admin"]);
      add_action("admin_menu", [$this, "add_admin_pages"]);
    }

    function add_admin_pages()
    {
      add_menu_page(
        "Smart Plugin",
        "Smart Delivery",
        "manage_options",
        "smart_plugin",
        [$this, "admin_index"],
        "dashicons-store",
        110
      );

      add_filter("plugin_action_links_$this->plugin_name", [
        $this,
        "settings_link",
      ]);
    }

    public function settings_link($links)
    {
      $settings_link = '<a href="admin.php?page=smart_plugin">Settings</a>';
      array_push($links, $settings_link);
      return $links;
    }

    public function admin_index()
    {
      require_once plugin_dir_path(__FILE__) . "templates/admin.php";
    }

    function register_public_scripts()
    {
      add_action("wp_enqueue_scripts", [$this, "enqueue_public"]);
    }

    protected function create_post_type()
    {
      add_action("init", [$this, "custom_post_type"]);
    }

    function custom_post_type()
    {
      register_post_type("product", ["public" => true, "label" => "Products"]);
    }

    function enqueue_admin()
    {
      wp_enqueue_style(
        "smartstyle",
        plugins_url("/assets/admin/styles.css", __FILE__)
      );
      wp_enqueue_script(
        "smartscript",
        plugins_url("/assets/admin/script.js", __FILE__)
      );
    }

    function enqueue_public()
    {
      wp_enqueue_style(
        "smartstyle",
        plugins_url("/assets/styles.css", __FILE__)
      );
      wp_enqueue_script(
        "smartscript",
        plugins_url("/assets/script.js", __FILE__)
      );
    }

    function activate()
    {
      require_once plugin_dir_path(__FILE__) .
        "includes/smart-plugin-activate.php";
      SmartdeliveryPluginActivate::activate();
    }
  }

  $SmartdeliveryPlugin = new SmartdeliveryPlugin();
  $SmartdeliveryPlugin->register_admin();

  // activation

  register_activation_hook(__FILE__, [$SmartdeliveryPlugin, "activate"]);

  // deactivation
  require_once plugin_dir_path(__FILE__) .
    "includes/smart-plugin-deactivate.php";
  register_deactivation_hook(__FILE__, [
    "SmartdeliveryPluginDeactivate",
    "deactivate",
  ]);
}
