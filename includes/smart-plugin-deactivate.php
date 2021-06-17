<?php
/**
 * @package SmartdeliveryPlugin
 */

class SmartdeliveryPluginDeactivate
{
  public static function deactivate()
  {
    flush_rewrite_rules();
  }
}
