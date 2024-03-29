<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes;

final class Init
{
	/**
	 * Store all the class inside an array
	 * @return array full list of classes
	 */

	public static function get_services()
	{
		return [
			Pages\Dashboard::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\CustomPostTypeController::class,
			Base\CustomTaxonomyController::class,
			Base\WidgetController::class,
			Base\TestimonialController::class,
			Base\ContactController::class,
			Base\TemplateController::class,
			// Base\AuthController::class,
			Base\RegisterController::class,
			Base\QuoteController::class,
			Base\RateController::class,
			Base\LandingController::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register method if it exists
	 * @return
	 */
	public static function register_services()
	{
		foreach (self::get_services() as $class) {
			$service = self::instantiate($class);
			if (method_exists($service, "register")) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param class $class    class from the services array
	 * @return class instance new instance of the class
	 */
	private static function instantiate($class)
	{
		$service = new $class();
		return $service;
	}
}
