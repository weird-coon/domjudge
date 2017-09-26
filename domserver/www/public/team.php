<?php
/**
 * View team details
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

$id = getRequestID();
if ( empty($id) ) error("Missing or invalid team id");

$title = 'Team t'.specialchars(@$id);
$menu = false;
require(LIBWWWDIR . '/header.php');
echo "<div class='container' style='margin-bottom: 100px;'>";

putTeam($id);

echo "<p><a href=\"./\">return to scoreboard</a></p>\n\n";
echo "</div>";
require(LIBWWWDIR . '/footer.php');
