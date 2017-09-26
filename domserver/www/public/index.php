<?php
/**
 * Produce a total score. Call with parameter 'static' for
 * output suitable for static HTML pages.
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');
$title="Scoreboard";
// set auto refresh
$refresh="1000;url=./";

// This reads and sets a cookie, so must be called before headers are sent.
$filter = initScorefilter();

$menu = true;
require(LIBWWWDIR . '/header.php');

$isstatic = @$_SERVER['argv'][1] == 'static' || isset($_REQUEST['static']);

if ( ! $isstatic ) {
	echo "<div class=\"container\" id=\"menutopright\">\n";
	// echo "<div id=\"menutopright\">\n";
	putClock();
	echo "</div>\n";
}

// call the general putScoreBoard function from scoreboard.php
?>
<div class="container">
<?php
putScoreBoard($cdata, null, $isstatic, $filter);
echo "</div>";
echo "</div>";
echo "<script type=\"text/javascript\">initFavouriteTeams();</script>";

require(LIBWWWDIR . '/footer.php');
