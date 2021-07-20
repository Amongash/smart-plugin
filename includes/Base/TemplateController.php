<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

use Includes\Base\BaseController;

class TemplateController extends BaseController
{

    public $templates;

    public function register()
    {
        if (!$this->activated("templates_manager")) {
            return;
        }

        $this->templates = ["page-templates/two-columns-tpl.php" => "Two Columns Layout"];

        add_filter("theme_page_templates", [$this, 'custom_templates']);
        add_filter("template_include", [$this, "load_template"]);
    }

    public function custom_templates($templates)
    {
        return array_merge($templates, $this->templates);
    }

    public function load_template($template)
    {
        global $post;

        if (!$post) {
            return $template;
        }

        $template_name = get_post_meta($post->ID, '_wp_page_template', true);

        if (!isset($this->templates[$template_name])) {
            return $template;
        }

        $file = $this->plugin_path . $template_name;
        if (file_exists($file)) {
            return $file;
        }
        return $template;
    }


}

