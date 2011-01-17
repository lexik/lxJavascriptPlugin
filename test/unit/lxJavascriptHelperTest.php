<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';
require_once dirname(__FILE__).'/../../lib/lxJavascriptStorage.class.php';
require_once dirname(__FILE__).'/../../lib/helper/lxJavascriptHelper.php';

$t = new lime_test(5);

lx_javascript('url1');
ob_start();
lx_include_javascripts();
$output = ob_get_clean();
$t->is($output, '
<script type="text/javascript" src="url1"></script>', 'adding a remote source using "lx_javascript(url)"');

lx_javascript('url2', true);
ob_start();
lx_include_javascripts();
$output = ob_get_clean();
$t->is($output, '
<script type="text/javascript" src="url2"></script>
<script type="text/javascript" src="url1"></script>', 'adding a prioritized remote source using "lx_javascript(url, true)"');

lx_javascript();
echo '<script type="text/javascript">
/* javascript code */
</script>';
lx_end_javascript();
ob_start();
lx_include_javascripts();
$output = ob_get_clean();
$t->is($output, '
<script type="text/javascript" src="url2"></script>
<script type="text/javascript" src="url1"></script>
<script type="text/javascript">/* <![CDATA[ */

/* javascript code */
/* ]]> */</script>
', 'adding a code block with <script> tag using lx_javascript() and lx_end_javascript()');

lx_javascript();
echo '<script type="text/javascript">/*<![CDATA[*/
/* javascript code 2 */
/*]]>*/</script>';
lx_end_javascript(true);
ob_start();
lx_include_javascripts();
$output = ob_get_clean();
$t->is($output, '
<script type="text/javascript" src="url2"></script>
<script type="text/javascript" src="url1"></script>
<script type="text/javascript">/* <![CDATA[ */
/**/
/* javascript code 2 */
/**/
/* javascript code */
/* ]]> */</script>
', 'adding a prioritized code block with CDATA and <script> tag using lx_javascript() and "lx_end_javascript(true)"' );

lx_javascript();
echo '/* javascript code 3 */';
lx_end_javascript();
ob_start();
lx_include_javascripts();
$output = ob_get_clean();
$t->is($output, '
<script type="text/javascript" src="url2"></script>
<script type="text/javascript" src="url1"></script>
<script type="text/javascript">/* <![CDATA[ */
/**/
/* javascript code 2 */
/**/
/* javascript code */
/* javascript code 3 *//* ]]> */</script>
', 'adding a code block with no <script> tag using lx_javascript() and lx_end_javascript()');
