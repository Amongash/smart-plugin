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

  public function __construct()
  {
    $this->settings = new Settings();
  }

  public function register()
  {
    // add_action("admin_menu", [$this, "add_admin_pages"]);

    $pages = [
      [
        "page_title" => "Smart Plugin",
        "menu_title" => "Smart Delivery",
        "capability" => "manage_options",
        "menu_slug" => "smart_plugin",
        "callback" => function () {
          echo "<h1> World</h1>";
        },
        "icon_url" => "dashicons-external",
        "position" => 2,
      ],
    ];

    $this->settings->addPages($pages)->register();
  }

  // function add_admin_pages()
  // {
  //   add_menu_page(
  //     "Smart Plugin",
  //     "Smart Delivery",
  //     "manage_options",
  //     "smart_plugin",
  //     [$this, "admin_index"],
  //     "dashicons-store",
  //     110
  //   );
  // }

  // public function admin_index()
  // {
  //   require_once $this->plugin_path . "templates/admin.php";
  // }
}
