<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

class Activate
{
	public static function activate()
	{
		flush_rewrite_rules();
		$default = [];
		if (!get_option("smart_plugin")) {
			update_option("smart_plugin", $default);
		}
		if (!get_option("smart_plugin_cpt")) {
			update_option("smart_plugin_cpt", $default);
		}
		if (!get_option("smart_plugin_tax")) {
			update_option("smart_plugin_tax", $default);
		}
	}
}
