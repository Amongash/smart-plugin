<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Pages;

use Includes\Base\BaseController;

class Admin extends BaseController
{
  public function register()
  {
    add_action("admin_menu", [$this, "add_admin_pages"]);
  }

  function add_admin_pages()
  {
    add_menu_page(
      "Smart Plugin",
      "Smart Delivery",
      "manage_options",
      "smart_plugin",
      [$this, "admin_index"],
      "dashicons-store",
      110
    );
  }

  public function admin_index()
  {
    require_once $this->plugin_path . "templates/admin.php";
  }
}
