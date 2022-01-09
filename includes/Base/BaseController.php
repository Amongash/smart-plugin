<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

class BaseController
{
	public $plugin_path;
	public $plugin_url;
	public $plugin;
	public $managers = [];

	public function __construct()
	{
		$this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
		$this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
		$this->plugin = plugin_basename(dirname(__FILE__, 3)) . "/smart-plugin.php";
		$this->managers = [
			"cpt_manager" => "Activate CPT Manager",
			"taxonomy_manager" => "Activate Taxonomy Manager",
			// "media_widget" => "Activate Media Widget",
			// "gallery_manager" => "Activate Gallery Manager",
			// "testimonial_manager" => "Activate Testimonial Manager",
			"templates_manager" => "Activate Custom Templates",
			// "login_manager" => "Activate Ajax Login/Signup",
			// "membership_manager" => "Activate Membership Manager",
			// "chat_manager" => "Activate Chat Manager",
			"contact_form" => "Activate Contact Form",
			"register_form" => "Activate Registration Form",
			"quote_form" => "Activate Quote Form",
			"rate_table" => "Activate Rate Table",
		];
	}

	public function activated(string $key)
	{
		$option = get_option("smart_plugin");

		return isset($option[$key]) ? $option[$key] : false;
	}
}
