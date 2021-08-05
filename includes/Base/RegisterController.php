<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Base\BaseController;

define('ACCOUNTS', 'shipping_accounts');

class RegisterController extends BaseController
{

    public $shipping_accounts;

    public function register()
    {

        if (!$this->activated("register_form")) {
            return;
        }

        add_shortcode("register-form", [$this, "register_form"]);
        add_action("wp_ajax_submit_register", [$this, "submit_register"]);
        add_action("wp_ajax_nopriv_submit_register", [$this, "submit_register"]);
    }

    public function register_form()
    {
        ob_start();
        echo "<link href=\"$this->plugin_url/assets/css/register.css\" type=\"text/css\" media=\"all\" rel=\"stylesheet\">";
        require_once "$this->plugin_path/templates/register.php";
        echo "<script src=\"$this->plugin_url/assets/js/register.js\"></script>";
        return ob_get_clean();
    }

    public function submit_register()
    {
        global $wpdb;
        $table = $wpdb->base_prefix . ACCOUNTS;

        if (!DOING_AJAX || !check_ajax_referer("register-nonce", "register-nonce")) {
            return $this->return_json("error");
        }

        $first_name = sanitize_text_field($_POST["first_name"]);
        $last_name = sanitize_text_field($_POST["last_name"]);
        $phone = $this->normalizeTelephoneNumber($_POST["phone"]);
        $email = sanitize_email($_POST["email"]);
        $gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
        $gender = $gender === "male" ? 'M' : 'F';
        $agreement = filter_var($_POST["agreement"], FILTER_SANITIZE_STRING);
        $agreement = $agreement === "on" ? true : false;

        $data = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "agreement" => $agreement,
        ];

        $exists = $wpdb->get_row("Select * from $table where email = '$email'");
        if ($exists) {
            return $this->return_json("This email is in use. Please check your inbox.");
        }

        $result = $wpdb->insert($table, $data);

        if ($result) {

            $subject = "New Shipping Address for " . $first_name;
            // $message = file_get_contents("$this->plugin_path/templates/email.php");
            $message = $this->generate_message_body($first_name);
            if ($this->send_mail($email, $subject, $message)) {
                return $this->return_json("success");
            }
            return $this->return_json("Unable to send email.");
        }

        return $this->return_json("error");
    }

    public function generate_message_body($first_name)
    {

        $message =  "<h1>Welcome to Smart Delivery</h1>";
        $message .= "<p>Dear $first_name,</p>";
        $message .= "<p>Thank you for signing up with Smart Delivery.</p>";
        $message .= "<p>You are now ready to begin shopping from thousands of U.S. online stores.</p>";
        $message .= "<br/>";
        $message .= "<p>Simply enter your provided address as your shipping address for us to receive </p>";
        $message .= "<p>your packages and ship them to your doorstep in Kenya.</p>";
        $message .= "<br/>";
        $message .= "<br/>";
        $message .= "<br/>";
        $message .= "<p>If the merchant won’t accept your international Visa or </p>";
        $message .= "<p>MasterCard debit card or don't know how to shop online, you can use our BuyForMe service.</p>";

        return $message;
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
