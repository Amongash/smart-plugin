<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;
use Includes\Api\Callbacks\ContactCallbacks;

/**
 *
 */
class ContactController extends BaseController
{
	public $callbacks;

	public $subpages = [];



	public function register()
	{
		if (!$this->activated("contact_form")) {
			return;
		}

		$this->settings = new SettingsApi();
		$this->callbacks = new ContactCallbacks();
		add_action("init", [$this, "contact_cpt"]);

		add_action("manage_contact_posts_columns", [
			$this,
			"set_custom_columns",
		]);
		add_action(
			"manage_contact_posts_custom_column",
			[$this, "set_custom_columns_data"],
			10,
			2
		);
		add_filter("manage_edit-contact_sortable_columns", [
			$this,
			"set_custom_columns_sortable",
		]);

		$this->setShortcodePage();
		add_shortcode("contact-form", [$this, "contact_form"]);
		add_action("wp_ajax_submit_contact", [$this, "submit_contact"]);
		add_action("wp_ajax_nopriv_submit_contact", [$this, "submit_contact"]);
	}

	public function submit_contact()
	{
		if (!DOING_AJAX || !check_ajax_referer("contact-nonce", "nonce")) {
			return $this->return_json("error");
		}

		$name = sanitize_text_field($_POST["name"]);
		$email = sanitize_email($_POST["email"]);
		$message = sanitize_textarea_field($_POST["message"]);

		$data = [
			"name" => $name,
			"email" => $email,
			"message" => $message,
		];

		$args = [
			"post_title" => "Message from " . $name,
			"post_content" => $message,
			"post_author" => 1,
			"post_status" => "publish",
			"post_type" => "contact",
			"meta_input" => ["_smart_contact_key" => $data],
		];

		$postId = wp_insert_post($args);
		if ($postId) {
			return $this->return_json("success");
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

	public function contact_form()
	{
		ob_start();
		echo "<link href=\"$this->plugin_url/assets/css/form.css\" type=\"text/css\" media=\"all\" rel=\"stylesheet\">";
		require_once "$this->plugin_path/templates/contact-form.php";
		echo "<script src=\"$this->plugin_url/assets/js/form.js\"></script>";
		return ob_get_clean();
	}


	public function setShortcodePage()
	{
		$subpage = [
			[
				"parent_slug" => "edit.php?post_type=contact",
				"page_title" => "Shortcodes",
				"menu_title" => "Shortcodes",
				"capability" => "manage_options",
				"menu_slug" => "smart_contact_shortcode",
				"callback" => [$this->callbacks, "shortcodePage"],
			],
		];

		$this->settings->addSubPages($subpage)->register();
	}

	public function contact_cpt()
	{
		$labels = [
			"name" => "Messages",
			"singular_name" => "message",
		];

		$args = [
			"labels" => $labels,
			"public" => true,
			"has_archive" => true,
			"menu_icon" => "dashicons-email",
			"exclude_from_search" => true,
			"publicly_queryable" => false,
			"supports" => ["revisions"],
			'capabilities' => [
				'create_posts' => 'do_not_allow'
			]
		];

		register_post_type("contact", $args);
	}



	public function set_custom_columns($columns)
	{
		$date = $columns['date'];
		unset($columns["title"], $columns["date"]);

		$columns["name"] = "Name";
		$columns["email"] = "Email";
		$columns["message"] = "Message";
		$columns["date"] = $date;

		return $columns;
	}

	public function set_custom_columns_data($column, $post_id)
	{
		$data = get_post_meta($post_id, "_smart_contact_key", true);

		$name = isset($data["name"]) ? $data["name"] : "";
		$email = isset($data["email"]) ? $data["email"] : "";
		$message = isset($data["message"]) ? $data["message"] : "";


		switch ($column) {
			case "name":
				echo "<strong>" .
					$name .
					"</strong>";
				break;
			case "email":
				echo '<a href="mailto:' . $email . '">' . $email . '</a>';
				break;
			case "message":
				echo $message;
				break;
		}
	}

	public function set_custom_columns_sortable($columns)
	{
		$columns["name"] = "name";
		$columns["email"] = "email";
		return $columns;
	}
}
