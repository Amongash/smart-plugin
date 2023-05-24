<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;

/**
 *
 */
class LandingController extends BaseController
{

	public function register()
    {

        // if (!$this->activated("landing_page")) {
        //     return;
        // }
        add_shortcode("landing-page", [$this, "landing_page"]);
        // add_action("wp_ajax_submit_register", [$this, "submit_register"]);
        // add_action("wp_ajax_nopriv_submit_register", [$this, "submit_register"]);
    }


    public function landing_page()
    {
        ob_start();
        // echo "<link href=\"$this->plugin_url/assets/css/landing.css\" type=\"text/css\" media=\"all\" rel=\"stylesheet\">";
        require_once "$this->plugin_path/templates/landing-page.php";
        echo "<script src=\"$this->plugin_url/assets/js/landing.js\"></script>";
        return ob_get_clean();
    }



}
