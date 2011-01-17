<?php
/**
 * Helper similar to JavascriptHelper, but storing javascript code for an aggregated rendering.
 *
 * @package   lxJavascriptPlugin
 * @author    http://www.lexik.fr
 */

/**
 * Include an external javascript source if $url, or starts a javascript code block.
 *
 * @param string $url
 * @param boolean $prioritize
 */
function lx_javascript($url = null, $prioritize = false)
{
  if ($url !== null)
  {
    $prioritize ? lxJavascriptStorage::addRemoteJavascriptFirst($url) : lxJavascriptStorage::addRemoteJavascript($url);
  }
  else
  {
    ob_start();
  }
}

/**
 * Ends and stores a javascript code block.
 *
 * @param boolean $prioritize
 */
function lx_end_javascript($prioritize = false)
{
  $prioritize ? lxJavascriptStorage::addJavascriptCodeFirst(ob_get_clean()) : lxJavascriptStorage::addJavascriptCode(ob_get_clean());
}

/**
 * Outputs stored javascripts.
 */
function lx_include_javascripts()
{
  foreach (lxJavascriptStorage::getRemoteJavascripts() as $remoteJavascript)
  {
    echo "\n<script type=\"text/javascript\" src=\"".$remoteJavascript."\"></script>";
  }
  $codeBlocks = lxJavascriptStorage::getJavascriptCodeBlocks();
  if (count($codeBlocks))
  {
    echo "\n<script type=\"text/javascript\">/* <![CDATA[ */\n";
    foreach ($codeBlocks as $javascriptCode)
    {
      echo $javascriptCode;
    }
    echo "/* ]]> */</script>\n";
  }
}
