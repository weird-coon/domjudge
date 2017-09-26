<?php
/**
 * View/download problem texts
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

$title = 'Problem statements';
require(LIBWWWDIR . '/header.php');
echo "<div style='margin-bottom: 100px' class='container'>";
echo "<h1 class='flow-text'>Problem statements</h1>\n\n";

putProblemTextList();
echo '</div>';
require(LIBWWWDIR . '/footer.php');
