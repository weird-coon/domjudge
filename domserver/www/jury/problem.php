<?php
/**
 * View a problem
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');

$id = getRequestID();
$current_cid = null;
if ( isset($_GET['cid']) && is_numeric($_GET['cid']) ) {
	$cid = $_GET['cid'];
	$cdata = $cdatas[$cid];
	$current_cid = $cid;
}
$title = 'Problem p'.specialchars(@$id);
$title = ucfirst((empty($_GET['cmd']) ? '' : specialchars($_GET['cmd']) . ' ') .
                 'problem' . ($id ? ' p'.specialchars(@$id) : ''));

if ( isset($_POST['cmd']) ) {
	$pcmd = $_POST['cmd'];
} elseif ( isset($_GET['cmd'] ) ) {
	$cmd = $_GET['cmd'];
} elseif ( isset($id) ) {
	$extra = '';
	if ( $current_cid !== null ) {
		$extra = '&cid=' . urlencode($current_cid);
	}
	$refresh = '15;url='.$pagename.'?id='.urlencode($id).$extra;
}

// This doesn't return, call before sending headers
if ( isset($cmd) && $cmd == 'viewtext' ) putProblemText($id);

require(LIBWWWDIR . '/header.php');
echo "<div class='container' style='margin-bottom: 100px;'>";


if ( isset($_POST['upload']) ) {
	if ( !empty($_FILES['problem_archive']['tmp_name'][0]) ) {
		foreach($_FILES['problem_archive']['tmp_name'] as $fileid => $tmpname) {
			$cid = $_POST['contest'];
			checkFileUpload( $_FILES['problem_archive']['error'][$fileid] );
			$zip = openZipFile($_FILES['problem_archive']['tmp_name'][$fileid]);
			$newid = importZippedProblem($zip, empty($id) ? NULL : $id, $cid);
			$zip->close();
			auditlog('problem', $newid, 'upload zip',
			         $_FILES['problem_archive']['name'][$fileid]);
		}
		if ( count($_FILES['problem_archive']['tmp_name']) == 1 ) {
			$probid = empty($newid) ? $id : $newid;
			$probname = $DB->q('VALUE SELECT name FROM problem
			                    WHERE probid = %i', $probid);

			echo '<p><a href="' . $pagename.'?id='.urlencode($probid) .
			    '">Return to problem p' . specialchars($probid) .
			    ': ' . specialchars($probname) . ".</a></p>\n";
		}
		echo "<p><a href=\"problems.php\">Return to problems overview.</a></p>\n";
	} else {
		error("Missing filename for problem upload. Maybe you have to increase upload_max_filesize, see config checker.");
	}
	echo "</div>";
	require(LIBWWWDIR . '/footer.php');
	exit;
}

if ( !empty($cmd) ):

	requireAdmin();

	// echo "<h2 class=\"title-scoreboard flow-text\">$title</h2>\n\n";
	echo "<div class='row'>";
	echo "<div class='col s8 offset-s2'>";
    echo "<h2 class=\"title-scoreboard flow-text\">$title</h2>\n\n";

	echo addForm('edit.php', 'post', null, 'multipart/form-data');

	echo "<table class='white z-depth-1'>\n";

	if ( $cmd == 'edit' ) {
		echo "<tr><td class='tb-add'>Problem ID:</td><td>";
		$row = $DB->q('TUPLE SELECT p.probid,p.name,
		                            p.timelimit,p.memlimit,p.outputlimit,
		                            p.special_run,p.special_compare, p.special_compare_args,
		                            p.problemtext_type, COUNT(testcaseid) AS testcases
		               FROM problem p
		               LEFT JOIN testcase USING (probid)
		               WHERE probid = %i GROUP BY probid', $id);
		echo addHidden('keydata[0][probid]', $row['probid']);
		echo "p" . specialchars($row['probid']);
		echo "</td></tr>\n";
	}

?>
<tr><td class='tb-add'><label for="data_0__name_">Problem name:</label></td>
<td class="pd-add"><?php echo addInput('data[0][name]', @$row['name'], 30, 255, 'required')?></td></tr>

<?php
    if ( !empty($row['probid']) ) {
		echo '<tr><td class="tb-add">Testcases:</td><td>' .
			$row['testcases'] . ' <a href="testcase.php?probid=' .
			urlencode($row['probid']) . "\">details/edit</a></td></tr>\n";
	}
?>
<tr><td class='tb-add'><label for="data_0__timelimit_">Timelimit:</label></td>
<td class="pd-add"><?php echo addInputField('number','data[0][timelimit]', @$row['timelimit'],
	' min="1" max="10000" required')?> sec</td></tr>

<tr><td class='tb-add'><label for="data_0__memlimit_">Memory limit:</label></td>
<td class="pd-add"><?php echo addInputField('number','data[0][memlimit]', @$row['memlimit']);
?> kB (leave empty for default)</td></tr>

<tr><td class='tb-add'><label for="data_0__outputlimit_">Output limit:</label></td>
<td class="pd-add"><?php echo addInputField('number','data[0][outputlimit]', @$row['outputlimit']);
?> kB (leave empty for default)</td></tr>

<tr><td class='tb-add'><label for="data_0__problemtext_">Problem text:</label></td>
<td class="pd-add"><?php
echo addFileField('data[0][problemtext]', 30, ' accept="text/plain,text/html,application/pdf"');
if ( !empty($row['problemtext_type']) ) {
	echo addCheckBox('unset[0][problemtext]') .
		'<label for="unset_0__problemtext_">delete</label>';
}
?></td></tr>

<tr><td class='tb-add'><label for="data_0__special_run_">Run script:</label></td>
<td class="pd-add">
<?php
$execmap = $DB->q("KEYVALUETABLE SELECT execid,description FROM executable
                   WHERE type = 'run' ORDER BY execid");
$execmap = array('' => 'default') + $execmap;
echo "<div style='width: 50%'>";
echo addSelect('data[0][special_run]', $execmap, @$row['special_run'], True);
echo '</div>';
?>
</td></tr>

<tr><td class='tb-add'><label for="data_0__special_compare_">Compare script:</label></td>
<td class="pd-add">
<?php
$execmap = $DB->q("KEYVALUETABLE SELECT execid,description FROM executable
                   WHERE type = 'compare' ORDER BY execid");
$execmap = array('' => 'default') + $execmap;
echo "<div style='width: 50%'>";
echo addSelect('data[0][special_compare]', $execmap, @$row['special_compare'], True);
echo "</div>";
?>
</td></tr>

<tr><td class='tb-add'><label for="data_0__special_compare_args_">Compare args:</label></td>
<td class="pd-add"><?php echo addInput('data[0][special_compare_args]', @$row['special_compare_args'], 30, 255)?></td></tr>

</table>
</div>
<!-- ./col -->
</div>
<!-- ./row -->
<?php
echo addHidden('cmd', $cmd) .
	addHidden('table','problem') .
	addHidden('referrer', @$_GET['referrer']);
echo '<div class="row">';
echo '<div class="col s8 offset-s2">'; 
echo addSubmit('Save') .
	 addSubmit('Cancel', 'cancel', null, true, 'formnovalidate');
echo addEndForm();


if ( class_exists("ZipArchive") ) {
	$contests = $DB->q("KEYVALUETABLE SELECT cid, CONCAT('c', cid, ': ' , shortname, ' - ', name) FROM contest");
	$values = array(-1 => 'Do not add / update contest data');
	foreach ($contests as $cid => $contest) {
		$values[$cid] = $contest;
	}
	echo "<br /><strong style='margin-top: 20px;font-size: 20px;'><em>or</em></strong><br /><br />\n" .
	addForm($pagename, 'post', null, 'multipart/form-data') .
	addHidden('id', @$row['probid']) .
	'<strong>Contest:</strong> ' .
	'<div style="width: 50%">'.
	addSelect('contest', $values, -1, true) .
	'</div>'.
	'<div class="file-field input-field">
      <div class="btn">
        <span for="problem_archive__">Upload problem archive:</span>'.
     addFileField('problem_archive[]') .
      '</div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>'.
	//'<label for="problem_archive__">Upload problem archive:</label>' .
	
	'<div style="margin-top: 10px;">'.
	addSubmit('Upload', 'upload') .
	'</div>'.
	addEndForm();
}
echo "</div>";
echo "</div>";
echo "</div>";
require(LIBWWWDIR . '/footer.php');
exit;

endif;

$data = $DB->q('TUPLE SELECT p.probid,p.name,
                             p.timelimit,p.memlimit,p.outputlimit,
                             p.special_run,p.special_compare,p.special_compare_args,
                             p.problemtext_type, count(rank) AS ntestcases
                FROM problem p
                LEFT JOIN testcase USING (probid)
                WHERE probid = %i GROUP BY probid', $id);

if ( ! $data ) error("Missing or invalid problem id");

if ( !isset($data['memlimit']) ) {
	$defaultmemlimit = TRUE;
	$data['memlimit'] = dbconfig_get('memory_limit');
}
if ( !isset($data['outputlimit']) ) {
	$defaultoutputlimit = TRUE;
	$data['outputlimit'] = dbconfig_get('output_limit');
}
if ( !isset($data['special_run']) ) {
	$defaultrun = TRUE;
	$data['special_run'] = dbconfig_get('default_run');
}
if ( !isset($data['special_compare']) ) {
	$defaultcompare = TRUE;
	$data['special_compare'] = dbconfig_get('default_compare');
}

echo "<h1 class=\"title-scoreboard flow-text\">Problem ".specialchars($data['name'])."</h1>\n\n";

echo addForm($pagename . '?id=' . urlencode($id),
             'post', null, 'multipart/form-data') . "<p>\n" .
	addHidden('id', $id) .
	"</p>\n";
?>
<table class="striped z-depth-2">
<tr><td class='tb-add'>ID:          </td><td class="pd-add">p<?php echo specialchars($data['probid'])?></td></tr>
<tr><td class='tb-add'>Name:        </td><td class="pd-add"><?php echo specialchars($data['name'])?></td></tr>
<tr><td class='tb-add'>Testcases:   </td><td class="pd-add"><?php
    if ( $data['ntestcases']==0 ) {
		echo '<em>no testcases</em>';
	} else {
		echo (int)$data['ntestcases'];
	}
	echo ' <a href="testcase.php?probid='.urlencode($data['probid']).'">details/edit</a>';
?></td></tr>
<tr><td class='tb-add'>Timelimit:   </td><td class="pd-add"><?php echo (int)$data['timelimit']?> sec</td></tr>
<tr><td class='tb-add'>Memory limit:</td><td class="pd-add"><?php	echo (int)$data['memlimit'].' kB'.(@$defaultmemlimit ? ' (default)' : '')?></td></tr>
<tr><td class='tb-add'>Output limit:</td><td class="pd-add"><?php echo (int)$data['outputlimit'].' kB'.(@$defaultoutputlimit ? ' (default)' : '')?></td></tr>
<?php
if ( !empty($data['color']) ) {
	echo '<tr><td>Colour:</td><td><div class="circle" style="background-color: ' .
		specialchars($data['color']) .
		';"></div> ' . specialchars($data['color']) .
		"</td></tr>\n";
}
if ( !empty($data['problemtext_type']) ) {
	echo '<tr><td class="tb-add">Problem text:</td><td class="nobreak tb-add><a href="problem.php?id=' .
	    urlencode($id) . '&amp;cmd=viewtext"><img src="../images/' .
	    urlencode($data['problemtext_type']) . '.png" alt="problem text" ' .
	    'title="view problem description" /></a> ' . "</td></tr>\n";
}

echo '<tr><td class="tb-add">Run script:</td><td class="filename">' .
	'<a href="executable.php?id=' . urlencode($data['special_run']) . '">' .
	specialchars($data['special_run']) . "</a>" .
	(@$defaultrun ? ' (default)' : '') . "</td></tr>\n";

echo '<tr><td class="tb-add">Compare script:</td><td class="filename">' .
	'<a href="executable.php?id=' . urlencode($data['special_compare']) . '">' .
	specialchars($data['special_compare']) . "</a>" .
	(@$defaultcompare ? ' (default)' : '') . "</td></tr>\n";

if ( !empty($data['special_compare_args']) ) {
	echo '<tr><td>Compare script arguments:</td><td>' .
		specialchars($data['special_compare_args']) . "</td></tr>\n";
}

echo "</table>\n" . addEndForm();

if ( IS_ADMIN ) {
	echo "<p>" .
		exportLink($id) . "\n" .
		editLink('problem',$id) . "\n" .
		delLink('problem','probid', $id) . "</p>\n\n";
}

echo rejudgeForm('problem', $id) . "<br />\n\n";

if ( $current_cid === null) {
	echo "<h3 style=\"font-size: 20px;\" class=\"title-scoreboard flow-text\">Contests</h3>\n\n";

	$res = $DB->q('TABLE SELECT c.*, cp.shortname AS problemshortname,
	                            cp.allow_submit, cp.allow_judge, cp.color
	               FROM contest c
	               INNER JOIN contestproblem cp USING (cid)
	               WHERE cp.probid = %i ORDER BY starttime DESC', $id);

	if ( count($res) == 0 ) {
		echo "<p class=\"nodata\">No contests defined</p>\n\n";
	}
	else {
		$times = array('activate', 'start', 'freeze', 'end', 'unfreeze');
		echo "<table class=\"striped z-depth-2 list sortable\">\n<thead>\n" .
		     "<tr><th scope=\"col\" class=\"sorttable_numeric\">CID</th>";
		echo "<th scope=\"col\">contest<br />shortname</th>\n";
		echo "<th scope=\"col\">contest<br />name</th>";
		echo "<th scope=\"col\">problem<br />shortname</th>";
		echo "<th scope=\"col\">allow<br />submit</th>";
		echo "<th scope=\"col\">allow<br />judge</th>";
		echo "<th class=\"sorttable_nosort\" scope=\"col\">colour</th>\n";
		echo "</tr>\n</thead>\n<tbody>\n";

		$iseven = false;
		foreach ( $res as $row ) {

			$link = '<a href="contest.php?id=' . urlencode($row['cid']) . '">';

			echo '<tr class="' .
			     ($iseven ? 'roweven' : 'rowodd') .
			     (!$row['enabled'] ? ' disabled' : '') . '">' .
			     "<td class=\"tdright\">" . $link .
			     "c" . (int)$row['cid'] . "</a></td>\n";
			echo "<td>" . $link . specialchars($row['shortname']) . "</a></td>\n";
			echo "<td>" . $link . specialchars($row['name']) . "</a></td>\n";
			echo "<td>" . $link . specialchars($row['problemshortname']) . "</a></td>\n";
			echo "<td class=\"tdcenter\">" . $link . printyn($row['allow_submit']) . "</a></td>\n";
			echo "<td class=\"tdcenter\">" . $link . printyn($row['allow_judge']) . "</a></td>\n";
			echo ( !empty($row['color'])
				? '<td title="' . specialchars($row['color']) .
				  '">' . $link . '<div class="circle" style="background-color: ' .
				  specialchars($row['color']) .
				  ';"></div></a></td>'
				: '<td>'. $link . '&nbsp;</a></td>' );

			$iseven = !$iseven;

			echo "</tr>\n";
		}
		echo "</tbody>\n</table>\n\n";
	}
}

echo "<h2 style=\"font-size: 20px; margin-top: 20px\" class=\"title-scoreboard flow-text\">Submissions for " . specialchars($data['name']) . "</h2>\n\n";

$restrictions = array( 'probid' => $id );
putSubmissions($cdatas, $restrictions);
echo "</div>";
echo "</div>";
echo "</div>";
require(LIBWWWDIR . '/footer.php');
