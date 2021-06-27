<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;
use Includes\Api\Callbacks\AdminCallbacks;

class CustomPostTypeController extends BaseController
{
	public $callbacks;
	public $subpages = [];
	public $custom_post_types = [];

	public function register()
	{
		$option = get_option("smart_plugin");

		$activated = isset($option["cpt_manager"]) ? $option["cpt_manager"] : false;
		if (!$activated) {
			return;
		}
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->setSubpages();
		$this->settings->addSubpages($this->subpages)->register();

		$this->storeCustomPostTypes();
		if (!empty($this->custom_post_types)) {
			add_action("init", [$this, "registerCustomPostTypes"]);
		}
	}

	public function storeCustomPostTypes()
	{
		$this->custom_post_types = [
			[
				"post_type" => "smart_products",
				"name" => "Products",
				"singular_name" => "Product",
				"public" => true,
				"has_archive" => true,
			],
			[
				"post_type" => "smart_orders",
				"name" => "Orders",
				"singular_name" => "Order",
				"public" => true,
				"has_archive" => false,
			],
		];
	}

	public function registerCustomPostTypes()
	{
		foreach ($this->custom_post_types as $post_type) {
			register_post_type($post_type["post_type"], [
				"labels" => [
					"name" => $post_type["name"],
					"singular_name" => $post_type["singular_name"],
				],
				"public" => $post_type["public"],
				"has_archive" => $post_type["has_archive"],
			]);
		}
	}

	public function setSubpages()
	{
		$this->subpages = [
			[
				"parent_slug" => "smart_plugin",
				"page_title" => "Custom Post Types",
				"menu_title" => "CPT Manager",
				"capability" => "manage_options",
				"menu_slug" => "smart_plugin_cpt",
				"callback" => [$this->callbacks, "adminCpt"],
			],
		];
	}
}
