<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

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
        wp_enqueue_style('quoteStyle', $this->plugin_url . 'assets/css/quote.css');
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
        $table = $wpdb->base_prefix . ACCOUNTS;

        if (!DOING_AJAX || !check_ajax_referer("quote-nonce", "quote-nonce")) {
            return $this->return_json("error");
        }

        $first_name = sanitize_text_field($_POST["first_name"]);
        $last_name = sanitize_text_field($_POST["last_name"]);
        $email = sanitize_email($_POST["email"]);
        $gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
        $gender = $gender === "male" ? 'M' : 'F';
        $agreement = filter_var($_POST["agreement"], FILTER_SANITIZE_STRING);
        $agreement = $agreement === "on" ? true : false;

        $data = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,

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

            // if ($this->send_mail($email, $subject, $message)) {
            //     return $this->return_json("success");
            // }
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
}
