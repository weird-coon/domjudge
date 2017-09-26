<?php
/**
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

$title = 'Import / Export';
require(LIBWWWDIR . '/header.php');
echo "<div class='container' style='margin-bottom: 100px;'>";
requireAdmin();

?>
<h1 style="font-size: 30px;" class="flow-text">Import and Export</h1>

<h2 class='flow-text' style='font-size: 20px;'>Import / Export via file down/upload</h2>

<ul>
<li><a href="impexp_contestyaml.php">Contest data (contest.yaml)</a></li>
<li><a href="problems.php">Problem archive</a></li>
<li>Tab separated, export:
	<a href="impexp_tsv.php?act=ex&amp;fmt=groups">groups.tsv</a>,
	<a href="impexp_tsv.php?act=ex&amp;fmt=teams">teams.tsv</a>,
	<a href="impexp_tsv.php?act=ex&amp;fmt=scoreboard">scoreboard.tsv</a>,
	<a href="impexp_tsv.php?act=ex&amp;fmt=results">results.tsv</a>
<li>
<?php echo addForm('impexp_tsv.php', 'post', null, 'multipart/form-data') .
	'Tab separated, import: ' .
	'<label for="fmt">type:</label> ' .
	'<div style="width:50%">'.
	addSelect('fmt',array('groups','teams','accounts')) .
        ', <label for="tsv">file:</label>' .
        '</div>'.
        addFileField('tsv') .
        addHidden('act','im') .
        addSubmit('import') .
        addEndForm();
?>
</li>
</ul>

<h2 class='flow-text' style='font-size: 20px;'>Import teams / Upload standings from / to icpc.baylor.edu</h2>

<p>
Create a "Web Services Token" with appropriate rights in the "Export" section
for your contest at <a
href="https://icpc.baylor.edu/login">https://icpc.baylor.edu/login</a>. You can
find the Contest ID (e.g. <code>Southwestern-Europe-2014</code>) in the URL.
</p>

<?php

echo addForm("impexp_baylor.php");
echo "<table class='white z-depth-1' style='margin-bottom: 20px;'>\n";
echo "<tr><td style='padding-left: 40px;'><label for=\"contest\">Contest ID:</label></td>" .
	"<td style='padding-right:100px;'>" . addInput('contest', @$contest, null, null, 'required') . "</td></tr>\n";
echo "<tr><td style='padding-left: 40px;'><label for=\"token\">Access token:</label></td>" .
	"<td style='padding-right:100px;'>" . addInput('token', @$token, null, null, 'required') . "</td></tr>\n";
echo "</table>\n";
echo addSubmit('Fetch teams', 'fetch') .
     addSubmit('Upload standings', 'upload') . addEndForm();
echo "</div>";
require(LIBWWWDIR . '/footer.php');
