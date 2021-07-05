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
		add_action("admin_enqueue_scripts", [$this, "enqueue"]);
	}

	function enqueue()
	{
		wp_enqueue_script("media-upload");
		wp_enqueue_media();
		wp_enqueue_style("smart-style", $this->plugin_url . "assets/css/style.css");
		wp_enqueue_script(
			"smart-script",
			$this->plugin_url . "assets/js/script.js"
		);
	}
}
