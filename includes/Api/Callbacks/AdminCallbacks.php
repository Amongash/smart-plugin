<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Api\Callbacks;

use Includes\Base\BaseController;

class AdminCallbacks extends BaseController
{
  public function adminDashboard()
  {
    return require_once "$this->plugin_path/templates/admin.php";
  }

  public function adminTaxonomies()
  {
    return require_once "$this->plugin_path/templates/taxonomies.php";
  }

  public function adminCpt()
  {
    return require_once "$this->plugin_path/templates/cpt.php";
  }

  public function adminForms()
  {
    return require_once "$this->plugin_path/templates/form.php";
  }

  public function smartOptionsGroup($input)
  {
    return $input;
  }

  public function smartAdminSection()
  {
    echo "This is a section";
  }

  public function smartTextExample()
  {
    $value = esc_attr(get_option("text_example"));
    echo '<input type="text" class="regular_text" name ="text_example" value="' .
      $value .
      '" placeholder="Write Something Here"> ';
  }
}
