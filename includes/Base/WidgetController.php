<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Base\BaseController;
use Includes\Api\Widgets\MediaWidget;

class WidgetController extends BaseController
{
	public function register()
	{
		if (!$this->activated("media_widget")) {
			return;
		}

		$media_widget = new MediaWidget();
		$media_widget->register();
	}
}
