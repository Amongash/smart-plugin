<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Pages;

use Includes\Base\BaseController;
use Includes\Api\Settings;

class Admin extends BaseController
{
  public $settings;
  public $pages = [];
  public $subpages = [];

  public function __construct()
  {
    $this->settings = new Settings();
    $this->pages = [
      [
        "page_title" => "Smart Plugin",
        "menu_title" => "Smart Delivery",
        "capability" => "manage_options",
        "menu_slug" => "smart_plugin",
        "callback" => function () {
          echo "<h1>Hello World</h1>";
        },
        "icon_url" => "dashicons-external",
        "position" => 2,
      ],
    ];

    $this->subpages = [
      [
        "parent_slug" => "smart_plugin",
        "page_title" => "Custom Post Types",
        "menu_title" => "CPT",
        "capability" => "manage_options",
        "menu_slug" => "smart_plugin_cpt",
        "callback" => function () {
          echo "<h1>CPT Manager</h1>";
        },
      ],
      [
        "parent_slug" => "smart_plugin",
        "page_title" => "Custom Taxonomies",
        "menu_title" => "Taxonomies",
        "capability" => "manage_options",
        "menu_slug" => "smart_plugin_taxonomies",
        "callback" => function () {
          echo "<h1>Custom Taxonomies</h1>";
        },
      ],
    ];
  }

  public function register()
  {
    $this->settings
      ->addPages($this->pages)
      ->withSubPage("Dashboard")
      ->addSubpages($this->subpages)
      ->register();
  }
}
