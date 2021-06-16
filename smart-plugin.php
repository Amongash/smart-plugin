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
    register_post_type("contact", ["public" => true, "label" => "Contacts"]);
  }
}

if (class_exists("SmartdeliveryPlugin")) {
  $SmartdeliveryPlugin = new SmartdeliveryPlugin();
}

register_activation_hook(__FILE__, [$SmartdeliveryPlugin, "activate"]);

register_deactivation_hook(__FILE__, [$SmartdeliveryPlugin, "deactivate"]);
