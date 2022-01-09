<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Base\BaseController;

define('QUOTATION', 'user_quotations');
class QuoteController extends BaseController
{
    public function register()
    {

        if (!$this->activated("quote_form")) {
            return;
        }

        add_action('wp_enqueue_scripts', [$this, "enqueue"]);
        add_shortcode("quote-form", [$this, "quote_form"]);
        add_action("wp_ajax_submit_quote", [$this, "submit_quote"]);
        add_action("wp_ajax_nopriv_submit_quote", [$this, "submit_quote"]);
    }

    public function enqueue()
    {
        if (!is_page('get-quote')) return;
        wp_enqueue_style('frontendStyle', $this->plugin_url . 'assets/css/frontend.css');
        wp_enqueue_style('quoteStyle', $this->plugin_url . 'assets/css/quote.css');
        wp_enqueue_script('jquery-validation-plugin', "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js", ["jquery"]);
        wp_enqueue_script('helperScript', $this->plugin_url . 'assets/js/helpers.js', ["jquery"], "", true);
        wp_enqueue_script('quoteScript', $this->plugin_url . 'assets/js/quote.js', ["jquery"], "", true);
    }

    public function quote_form()
    {
        ob_start();
        require_once "$this->plugin_path/templates/quote.php";
        return ob_get_clean();
    }

    public function submit_quote()
    {
        global $wpdb;
        $wpdb->show_errors();
        $table = $wpdb->base_prefix . QUOTATION;

        if (!DOING_AJAX || !check_ajax_referer("nonce", "nonce")) {

            return $this->return_json("error");
        }

        $first_name = sanitize_text_field($_POST["first_name"]);
        $last_name = sanitize_text_field($_POST["last_name"]);
        $email = sanitize_email($_POST["email"]);
        $phone = $this->normalizeTelephoneNumber($_POST["phone"]);
        $service = filter_var_array($_POST["service"], FILTER_SANITIZE_STRING);
        $products = filter_var_array($_POST["products"], FILTER_SANITIZE_STRING);
        $other_info  = sanitize_text_field($_POST["other_info"]);
        $data = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone,
            "service" => json_encode($service),
            "products" => json_encode($products),
            "other_info" => $other_info
        ];


        $result = $wpdb->insert($table, $data);


        if ($result) {
            return $this->return_json("success");
            $subject = "New quotation received for " . $first_name;
            $message = '';

            if ($this->send_mail('amongash08@gmail.com', $subject, $message)) {
                return $this->return_json("success");
            }
            return $this->return_json("Unable to send email.");
        }

        return $this->return_json("error");
    }


    public function return_json($status)
    {
        $return = [
            "status" => $status,
        ];
        wp_send_json($return);
        wp_die();
    }

    public function normalizeTelephoneNumber(string $telephone)
    {
        //remove white space, dots, hyphens and brackets
        $telephone = str_replace([' ', '.', '-', '(', ')'], '', $telephone);
        return $telephone;
    }


    public function send_mail($to, $subject, $message)
    {
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Smart Delivery <info@smartdelivery.co.ke>'
        ];
        add_filter('wp_mail_content_type', [$this, 'set_html_content_type']);
        add_filter("wp_mail_from", [$this, "smart_mail_from"]);
        add_filter("wp_mail_from_name", [$this, "smart_mail_from_name"]);
        if (wp_mail($to, $subject, $message, $headers)) {
            remove_filter('wp_mail_content_type', [$this, 'set_html_content_type']);
            return true;
        }
        return false;
    }

    public function set_html_content_type()
    {
        return 'text/html';
    }


    public function smart_mail_from()
    {
        return "info@smartdelivery.com";
    }

    public function smart_mail_from_name()
    {
        return "Smart Delivery";
    }
}
