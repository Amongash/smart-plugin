<?php
/**
 * @package SmartdeliveryPlugin
 **/
/*
Plugin Name: Smartdelivery Plugin
Description: Custom forms for Smartdelivery
Version: 1.0.0
Author: Amos Kamari 
Author URI: http://github.com/amongash
License: None
*/

defined("ABSPATH") or die();

class SmartdeliveryPlugin
{
  function __construct()
  {
    add_action("init", [$this, "custom_post_type"]);
  }

  function register_admin_scripts()
  {
    add_action("admin_enqueue_scripts", [$this, "enqueue"]);
  }

  function register_public_scripts()
  {
    add_action("wp_enqueue_scripts", [$this, "enqueue"]);
  }

  function activate()
  {
    $this->custom_post_type();
    flush_rewrite_rules();
  }

  function deactivate()
  {
    flush_rewrite_rules();
  }

  function custom_post_type()
  {
    register_post_type("product", ["public" => true, "label" => "Products"]);
  }

  function enqueue()
  {
    wp_enqueue_style("smartstyle", plugins_url("/assets/styles.css", __FILE__));
    wp_enqueue_script(
      "smartscript",
      plugins_url("/assets/script.js", __FILE__)
    );
  }
}

if (class_exists("SmartdeliveryPlugin")) {
  $SmartdeliveryPlugin = new SmartdeliveryPlugin();
  $SmartdeliveryPlugin->register_admin_scripts();
}

register_activation_hook(__FILE__, [$SmartdeliveryPlugin, "activate"]);

register_deactivation_hook(__FILE__, [$SmartdeliveryPlugin, "deactivate"]);
