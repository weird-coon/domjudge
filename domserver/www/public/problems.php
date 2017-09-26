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
?>
<div class="container" style="margin-top: 50px; padding-bottom: 150px;">
<h1 class="title-scoreboard flow-text">Danh sách bài tập</h1>
<?php
	putProblemTextList();
?>
</div>
<!-- ./container -->
<?php
require(LIBWWWDIR . '/footer.php');

?>
