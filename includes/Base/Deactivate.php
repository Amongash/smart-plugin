<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

class Deactivate
{
  public static function deactivate()
  {
    flush_rewrite_rules();
  }
}
