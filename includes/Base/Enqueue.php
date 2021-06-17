<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Base\BaseController;
class Enqueue extends BaseController
{
  public function register()
  {
    $this->register_admin();
    $this->register_public();
  }

  function register_admin()
  {
    add_action("admin_enqueue_scripts", [$this, "enqueue_admin"]);
  }

  function register_public()
  {
    add_action("wp_enqueue_scripts", [$this, "enqueue_public"]);
  }

  function enqueue_admin()
  {
    wp_enqueue_style(
      "smartstyle",
      $this->plugin_url . "/assets/admin/styles.css",
      __FILE__
    );
    wp_enqueue_script(
      "smartscript",
      $this->plugin_url . "/assets/admin/script.js",
      __FILE__
    );
  }

  function enqueue_public()
  {
    wp_enqueue_style(
      "smartstyle",
      $this->plugin_url . "/assets/styles.css",
      __FILE__
    );
    wp_enqueue_script(
      "smartscript",
      $this->plugin_url . "/assets/script.js",
      __FILE__
    );
  }
}
