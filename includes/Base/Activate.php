<?php
/**
 * @package SmartdeliveryPlugin
 */

namespace Includes\Base;

class Activate
{
  public static function activate()
  {
    flush_rewrite_rules();
  }
}
