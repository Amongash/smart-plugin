<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Api\Callbacks;

use Includes\Base\BaseController;

class TestimonialCallbacks extends BaseController
{
	public function shortcodePage()
	{
		return require_once "$this->plugin_path/templates/testimonial.php";
	}
}
