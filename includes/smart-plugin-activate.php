<?php
/**
 * @package SmartdeliveryPlugin
 */

class SmartdeliveryPluginActivate
{
  public static function activate()
  {
    flush_rewrite_rules();
  }
}
