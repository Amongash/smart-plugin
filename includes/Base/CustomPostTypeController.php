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

		add_action("init", [$this, "activate"]);
	}

	public function activate()
	{
		register_post_type("smart_products", [
			"labels" => ["name" => "Products", "singular_name" => "Product"],
			"public" => true,
			"has_archive" => true,
		]);
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
