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

defined("ABSPATH") or die("Hey, what are you doing here? You silly human!");

if (file_exists(dirname(__FILE__) . "/vendor/autoload.php")) {
  require_once dirname(__FILE__) . "/vendor/autoload.php";
}

/**
 * Code that runs during plugin activation
 */
function activate_smart_plugin()
{
  Includes\Base\Activate::activate();
}

/**
 * Code that runs during plugin deactivation
 */
function deactivate_smart_plugin()
{
  Includes\Base\Deactivate::deactivate();
}

// activation
register_activation_hook(__FILE__, "activate_smart_plugin");

// deactivation
register_deactivation_hook(__FILE__, "deactivate_smart_plugin");

if (class_exists("Includes\\Init")) {
  Includes\Init::register_services();
}
