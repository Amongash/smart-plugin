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

  public function adminTaxonomy()
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
}
