<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Api\Callbacks;

use Includes\Base\BaseController;

class ContactCallbacks extends BaseController
{
	public function shortcodePage()
	{
		return require_once "$this->plugin_path/templates/contact.php";
	}
}
