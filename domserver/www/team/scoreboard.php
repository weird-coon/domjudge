<?php
/**
 * Scoreboard
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

$pagename = basename($_SERVER['PHP_SELF']);

require('init.php');
$refresh = '30;url=scoreboard.php';
$title = 'Scoreboard';

// This reads and sets a cookie, so must be called before headers are sent.
$filter = initScorefilter();

require(LIBWWWDIR . '/header.php');
echo "<div style='margin-bottom: 100px' class='container'>";
// call the general putScoreBoard function from scoreboad.php
putScoreBoard($cdata, $teamid, FALSE, $filter);
echo '</div>';
require(LIBWWWDIR . '/footer.php');
