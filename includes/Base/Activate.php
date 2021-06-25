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

		if (get_option("smart_plugin")) {
			return;
		}

		$default = [];
		update_option("smart_plugin", $default);
	}
}
