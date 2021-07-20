<?php

/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Api\SettingsApi;
use Includes\Base\BaseController;
use Includes\Api\Callbacks\TaxonomyCallbacks;
use Includes\Api\Callbacks\AdminCallbacks;

class CustomTaxonomyController extends BaseController
{
	public $settings;
	public $callbacks;
	public $tax_callbacks;
	public $subpages = [];
	public $taxonomies = [];

	public function register()
	{

		if (!$this->activated("taxonomy_manager")) {
			return;
		}
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		$this->tax_callbacks = new TaxonomyCallbacks();
		$this->setSubpages();
		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addSubpages($this->subpages)->register();

		$this->storeCustomTaxonomies();
		if (!empty($this->taxonomies)) {
			add_action('init', [$this, 'registerCustomTaxonomy']);
		}
	}


	public function setSubpages()
	{
		$this->subpages = [
			[
				"parent_slug" => "smart_plugin",
				"page_title" => "Custom Taxonomies",
				"menu_title" => "Taxonomy Manager",
				"capability" => "manage_options",
				"menu_slug" => "smart_plugin_taxonomy",
				"callback" => [$this->callbacks, "adminTaxonomy"],
			],
		];
	}

	public function setSettings()
	{
		$args[] = [
			"option_group" => "smart_plugin_tax_settings",
			"option_name" => "smart_plugin_tax",
			"callback" => [$this->tax_callbacks, "taxSanitize"],
		];

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = [
			[
				"id" => "smart_tax_index",
				"title" => "Custom Taxonomy Manager",
				"callback" => [$this->tax_callbacks, "taxSectionManager"],
				"page" => "smart_plugin_taxonomy",
			],
		];
		$this->settings->setSections($args);
	}

	public function setFields()
	{
		$args = [
			[
				"id" => "taxonomy",
				"title" => "Custom Taxonomy ID",
				"callback" => [$this->tax_callbacks, "textField"],
				"page" => "smart_plugin_taxonomy",
				"section" => "smart_tax_index",
				"args" => [
					"option_name" => "smart_plugin_tax",
					"label_for" => "taxonomy",
					"placeholder" => "eg. genre",
					"array" => 'taxonomy'
				],
			],
			[
				'id' => 'singular_name',
				'title' => 'Singular Name',
				'callback' => [$this->tax_callbacks, 'textField'],
				'page' => 'smart_plugin_taxonomy',
				'section' => 'smart_tax_index',
				'args' => [
					'option_name' => 'smart_plugin_tax',
					'label_for' => 'singular_name',
					'placeholder' => 'eg. Genre',
					'array' => 'taxonomy'
				]
			],
			[
				'id' => 'hierarchical',
				'title' => 'Hierarchical',
				'callback' => [$this->tax_callbacks, 'checkboxField'],
				'page' => 'smart_plugin_taxonomy',
				'section' => 'smart_tax_index',
				'args' => [
					'option_name' => 'smart_plugin_tax',
					'label_for' => 'hierarchical',
					'class' => 'ui-toggle',
					'array' => 'taxonomy'
				]
			]
		];

		$this->settings->setFields($args);
	}

	public function storeCustomTaxonomies()
	{
		// get the taxonomies array
		$options = get_option('smart_plugin_tax') ?: [];

		// store those info into an array
		foreach ($options as $option) {
			$labels = [
				'name'              => $option['singular_name'],
				'singular_name'     => $option['singular_name'],
				'search_items'      => 'Search ' . $option['singular_name'],
				'all_items'         => 'All ' . $option['singular_name'],
				'parent_item'       => 'Parent ' . $option['singular_name'],
				'parent_item_colon' => 'Parent ' . $option['singular_name'] . ':',
				'edit_item'         => 'Edit ' . $option['singular_name'],
				'update_item'       => 'Update ' . $option['singular_name'],
				'add_new_item'      => 'Add New ' . $option['singular_name'],
				'new_item_name'     => 'New ' . $option['singular_name'] . ' Name',
				'menu_name'         => $option['singular_name'],
			];

			$this->taxonomies[] = [
				'hierarchical'      => isset($option['hierarchical']) ? true : false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => ['slug' => $option['taxonomy']],
			];
		}
		// register the taxonomy
	}

	public function registerCustomTaxonomy()
	{
		foreach ($this->taxonomies as $taxonomy) {
			register_taxonomy($taxonomy['rewrite']['slug'], ['post'], $taxonomy);
		}
	}
}
