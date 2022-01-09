<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

class RateController extends BaseController
{
    public function register()
    {

        if (!$this->activated("rate_table")) {
            return;
        }

        add_action('wp_enqueue_scripts', [$this, "enqueue"]);
        add_shortcode("rates-table", [$this, "rates_table"]);
    }

    public function enqueue()
    {
        if (!is_page('rates')) return;
        wp_enqueue_style('rates-style', $this->plugin_url . 'assets/css/rates.css');
    }

    public function rates_table()
    {
        ob_start();
        // echo "<link href=\"$this->plugin_url/assets/css/rates.css\" type=\"text/css\" media=\"all\" rel=\"stylesheet\">";
        require_once "$this->plugin_path/templates/rates.php";
        return ob_get_clean();
    }
}
