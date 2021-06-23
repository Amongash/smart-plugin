<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Pages;

use Includes\Base\BaseController;
use Includes\Api\SettingsApi;
use Includes\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
  public $settings;
  public $callbacks;
  public $pages = [];
  public $subpages = [];

  public function register()
  {
    $this->settings = new SettingsApi();
    $this->callbacks = new AdminCallbacks();
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
        "option_group" => "smart_options_group",
        "option_name" => "text_example",
        "callback" => [$this->callbacks, "smartOptionsGroup"],
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
        "id" => "text_example",
        "title" => "Text Example",
        "callback" => [$this->callbacks, "smartTextExample"],
        "page" => "smart_plugin",
        "section" => "smart_admin_index",
        "args" => ["label_for" => "text_example", "class" => "example-class"],
      ],
    ];
    $this->settings->setFields($args);
  }
}
