<?php

/**
 * Static methods to store and retrieve remote or inline javascript code
 *
 * @package     lxJavascriptPlugin
 * @author      http://www.lexik.fr
 */
class lxJavascriptStorage
{
  static private
    $javascript_remote = array(),
    $javascript_code   = array();

  /**
   * Stores an url for a remote script tag.
   *
   * @param string $remote_url
   */
  public static function addRemoteJavascript($remote_url)
  {
    self::$javascript_remote[] = $remote_url;
  }

  /**
   * Stores an url with rendering priority.
   *
   * @param string $remote_url
   */
  public static function addRemoteJavascriptFirst($remote_url)
  {
    array_unshift(self::$javascript_remote, $remote_url);
  }

  /**
   * Stores a javascript code snippet for further aggregated javascript rendering.
   *
   * @param string $code
   */
  public static function addJavascriptCode($code)
  {
    self::$javascript_code[] = self::getStrippedCode($code);
  }

  /**
   * Stores a javascript code snippet with rendering priority
   *
   * @param string $code
   */
  public static function addJavascriptCodeFirst($code)
  {
    array_unshift(self::$javascript_code, self::getStrippedCode($code));
  }

  /**
   * Javascript_remote getter
   *
   * @return array
   */
  public static function getRemoteJavascripts()
  {
    return self::$javascript_remote;
  }

  /**
   * Javascript_code getter
   *
   * @return array
   */
  public static function getJavascriptCodeBlocks()
  {
    return self::$javascript_code;
  }

  /**
   * Strip JS tags from a string.
   *
   * @param string $code
   * @return string
   */
  public static function getStrippedCode($code)
  {
    return preg_replace(array('/<script[^>]*>/', '/<\/script>/', '/<!\[CDATA\[/', '/]]>/'), '', $code);
  }
}
