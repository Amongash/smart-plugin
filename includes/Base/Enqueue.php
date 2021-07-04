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
		wp_enqueue_script("media-upload");
		wp_enqueue_media();
		wp_enqueue_style(
			"smart-style-admin",
			$this->plugin_url . "assets/admin/style.css"
		);
		wp_enqueue_script(
			"smart-script-admin",
			$this->plugin_url . "assets/admin/script.js"
		);
	}

	function enqueue_public()
	{
		wp_enqueue_style("smart-style", $this->plugin_url . "assets/style.css");
		wp_enqueue_script("smart-script", $this->plugin_url . "assets/script.js");
	}
}
