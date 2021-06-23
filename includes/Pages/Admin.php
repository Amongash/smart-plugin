<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Pages;

use Includes\Base\BaseController;
use Includes\Api\SettingsApi;
use Includes\Api\Callbacks\AdminCallbacks;
use Includes\Api\Callbacks\ManagerCallbacks;

class Admin extends BaseController
{
	public $settings;
	public $callbacks;
	public $callbacks_mngr;
	public $pages = [];
	public $subpages = [];

	public function register()
	{
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();
		$this->setPages();
		$this->setSubpages();
		$this->setSettings();
		$this->setSections();
		$this->setFields();
		$this->settings
			->addPages($this->pages)
			->withSubPage("Dashboard")
			->addSubpages($this->subpages)
			->register();
	}

	public function setPages()
	{
		$this->pages = [
			[
				"page_title" => "Smart Plugin",
				"menu_title" => "Smart Delivery",
				"capability" => "manage_options",
				"menu_slug" => "smart_plugin",
				"callback" => [$this->callbacks, "adminDashboard"],
				"icon_url" => "dashicons-external",
				"position" => 2,
			],
		];
	}

	public function setSubpages()
	{
		$this->subpages = [
			[
				"parent_slug" => "smart_plugin",
				"page_title" => "Custom Post Types",
				"menu_title" => "CPT",
				"capability" => "manage_options",
				"menu_slug" => "smart_plugin_cpt",
				"callback" => [$this->callbacks, "adminDashboard"],
			],
			[
				"parent_slug" => "smart_plugin",
				"page_title" => "Custom Taxonomies",
				"menu_title" => "Taxonomies",
				"capability" => "manage_options",
				"menu_slug" => "smart_plugin_taxonomies",
				"callback" => [$this->callbacks, "adminTaxonomies"],
			],
		];
	}

	public function setSettings()
	{
		$args = [
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "cpt_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "taxonomy_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "media_widget",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "gallery_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "testimonial_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "templates_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "login_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "membership_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
			[
				"option_group" => "smart_plugin_settings",
				"option_name" => "chat_manager",
				"callback" => [$this->callbacks, "checkboxSanitize"],
			],
		];
		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				"id" => "smart_admin_index",
				"title" => "Settings",
				"callback" => [$this->callbacks, "smartAdminSection"],
				"page" => "smart_plugin",
			],
		];
		$this->settings->setSections($args);
	}

	public function setFields()
	{
		$args = [
			[
				"id" => "cpt_manager",
				"title" => "Activate CPT Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "cpt_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "taxonomy_manager",
				"title" => "Activate Taxonomy Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "taxonomy_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "media_widget",
				"title" => "Activate Media Widget",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "media_widget", "class" => "ui-toggle"],
			],
			[
				"id" => "gallery_manager",
				"title" => "Activate Gallery Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "gallery_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "testimonial_manager",
				"title" => "Activate Testimonial Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => [
					"label_for" => "testimonial_manager",
					"class" => "ui-toggle",
				],
			],
			[
				"id" => "templates_manager",
				"title" => "Activate Templates Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "templates_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "templates_manager",
				"title" => "Activate Templates Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "templates_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "login_manager",
				"title" => "Activate Login Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "login_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "membership_manager",
				"title" => "Activate Membership Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "membership_manager", "class" => "ui-toggle"],
			],
			[
				"id" => "chat_manager",
				"title" => "Activate chat Manager",
				"callback" => [$this->callbacks_mngr, "checkboxField"],
				"page" => "smart_plugin",
				"section" => "smart_admin_index",
				"args" => ["label_for" => "chat_manager", "class" => "ui-toggle"],
			],
		];
		$this->settings->setFields($args);
	}
}
