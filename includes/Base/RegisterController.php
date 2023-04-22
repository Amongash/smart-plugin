<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Base\BaseController;

define('ACCOUNTS', 'shipping_accounts');
class RegisterController extends BaseController
{
    private function shipping_accounts()
    {
        global $wpdb;
        return $wpdb->base_prefix . ACCOUNTS;
    }

    function wpdb()
    {
        global $wpdb;
        return $wpdb;
    }


    public function register()
    {

        if (!$this->activated("register_form")) {
            return;
        }

        add_action('wp_enqueue_scripts', [$this, "enqueue"]);
        add_shortcode("register-form", [$this, "register_form"]);
        add_action("wp_ajax_submit_register", [$this, "submit_register"]);
        add_action("wp_ajax_nopriv_submit_register", [$this, "submit_register"]);
    }

    public function enqueue()
    {
        if (!is_page('sign-up')) return;

        wp_enqueue_style('frontendStyle', $this->plugin_url . 'assets/css/frontend.css');
        wp_enqueue_style('registerStyle', $this->plugin_url . 'assets/css/register.css');
    }



    public function register_form()
    {
        ob_start();
        require_once "$this->plugin_path/templates/register.php";
        return ob_get_clean();
    }

    public function submit_register()
    {
        global $wpdb;
        $table = $wpdb->base_prefix . ACCOUNTS;

        if (!DOING_AJAX || !check_ajax_referer("register-nonce", "register-nonce")) {
            return wp_send_json([
                "message" => "Invalid nonce provided. Please refresh your page and try again,",
                "success" => false
            ]);
        }

        $data = $this->validate_data($_POST);

        $result = $wpdb->insert($table, $data);


        if ($result) {

            $subject = "New Shipping Address for " . $data['first_name'];
            $message = $this->generate_message_body($data['first_name'], $data['last_name']);
            if ($this->send_mail($data['email'], $subject, $message)) {
                wp_send_json([
                    "message" => "Registration successful.",
                    "success" => true
                ]);
            }
        }
        wp_send_json([
            "data" => $data,
            "message" => "An error occurred. Please try again.",
            "success" => false
        ], 400);
    }

    private function validate_data($array)
    {
        // Check if email address exists in our database table
        $exists = $this->wpdb()->get_row("Select email from " . $this->shipping_accounts() . " where email =  '" . $array['email'] . "'");
        if ($exists) {
            wp_send_json(["message" => "The email provided is already in use. Please check your inbox.", "success" => false], 400);
        }

        $first_name = sanitize_text_field($array["first_name"]);
        $last_name = sanitize_text_field($array["last_name"]);
        $phone = $this->normalizeTelephoneNumber($array["phone"]);
        $email = sanitize_email($array["email"]);
        $gender = filter_var($array["gender"], FILTER_SANITIZE_STRING);
        $gender = $gender === "male" ? 'M' : 'F';
        $agreement = filter_var($array["agreement"], FILTER_SANITIZE_STRING);
        $agreement = $agreement === "on" ? true : false;

        return [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "agreement" => $agreement,
        ];
    }

    public function generate_message_body($first_name, $last_name)
    {

        $message =  "<h1>Welcome to Smart Delivery</h1>";
        $message .= "<p>Dear $first_name,</p>";
        $message .= "<p>Thank you for signing up with Smart Delivery.</p>";
        $message .= "<p>You are now ready to begin shopping from thousands of U.S. online stores.</p>";
        $message .= "<br/>";
        $message .= "<p>Simply enter your provided address as your shipping address for us to receive </p>";
        $message .= "<p>your packages and ship them to your doorstep in Kenya.</p>";
        $message .= "<br/>";
        $message .= "<p><strong>US DELIVERY ADDRESS</strong></p>";
        $message .= "<p> $first_name $last_name ACG-SD</p>";
        $message .= "<p> Phone: + 1 302 351 49 71</p>";
        $message .= "<p> Street Address: 17401 Nichols LN Unit J</p>";
        $message .= "<p> City:  Huntington Beach</p>";
        $message .= "<p> State: California</p>";
        $message .= "<p> Zipcode: 92647</p>";
        $message .= "<br/>";
        $message .= "<p><strong>UK DELIVERY ADDRESS</strong></p>";
        $message .= "<p> $first_name $last_name ACG-SD</p>";
        $message .= "<p> Phone: + 1 302 351 49 71</p>";
        $message .= "<p> Postcode: HA9 0JD</p>";
        $message .= "<p> Address line 1: Access Business Centre </p>";
        $message .= "<p> Address line 2: First Way </p>";
        $message .= "<p> Town/City: Wembley</p>";
        $message .= "<br/>";
        $message .= "<p>If the merchant won’t accept your international Visa or </p>";
        $message .= "<p>MasterCard debit card or don't know how to shop online, you can use our Purchase For Me service.</p>";

        return $message;
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
