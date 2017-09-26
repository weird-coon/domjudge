<?php
/**
 * View the problems
 *
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

require('init.php');
$title = 'Problems';

require(LIBWWWDIR . '/header.php');
echo "<div class='container' style='margin-bottom: 100px;'>";

echo "<h1 class=\"title-scoreboard flow-text\">Problems</h1>\n\n";

// Select all data
$res = $DB->q('SELECT p.probid,p.name,p.timelimit,p.memlimit,p.outputlimit,
               p.problemtext_type, COUNT(testcaseid) AS testcases
               FROM problem p
               LEFT JOIN testcase USING (probid)
               GROUP BY probid ORDER BY probid');

// Get number of active contests per problem
if ( count($cids)!=0 ) {
	$activecontests = $DB->q("KEYVALUETABLE SELECT probid, count(cid)
	                          FROM contestproblem
	                          WHERE cid IN (%As) GROUP BY probid", $cids);
} else {
	$activecontests = array();
}

if( $res->count() == 0 ) {
	echo "<p class=\"nodata\">No problems defined</p>\n\n";
} else {
	echo "<table class=\"striped z-depth-2 list sortable\">\n<thead>\n" .
	     "<tr><th scope=\"col\">ID</th><th scope=\"col\">name</th>" .
	     "<th scope=\"col\" class=\"sorttable_numeric\"># contests</th>" .
	     "<th scope=\"col\">time<br />limit</th>" .
	     "<th scope=\"col\">memory<br />limit</th>" .
	     "<th scope=\"col\">output<br />limit</th>" .
	     "<th scope=\"col\">test<br />cases</th>" .
	     "<th scope=\"col\"></th>" .
	    ( IS_ADMIN ? "<th scope=\"col\"></th><th scope=\"col\"></th>" : '' ) .
	     "</tr></thead>\n<tbody>\n";

	$lastcid = -1;

	while($row = $res->next()) {
		$classes = array();
		if ( !isset($activecontests[$row['probid']]) ) $classes[] = 'disabled';
		$link = '<a href="problem.php?id=' . urlencode($row['probid']) . '">';

		echo "<tr class=\"" . implode(' ',$classes) .
			"\"><td>" . $link . "p" .
				specialchars($row['probid'])."</a>".
			"</td><td>" . $link . specialchars($row['name'])."</a>".
			"</td><td>".
			$link . specialchars(isset($activecontests[$row['probid']])?$activecontests[$row['probid']]:0) . "</a>" .
			"</td><td>" . $link . (int)$row['timelimit'] . "</a>" .
			"</td><td>" . $link . (isset($row['memlimit']) ? (int)$row['memlimit'] : 'default') . "</a>" .
			"</td><td>" . $link . (isset($row['outputlimit']) ? (int)$row['outputlimit'] : 'default') . "</a>" .
			"</td><td><a href=\"testcase.php?probid=" . $row['probid'] .
			"\">" . $row['testcases'] . "</a></td>";
		if ( !empty($row['problemtext_type']) ) {
			echo '<td title="view problem description">' .
			     '<a href="problem.php?id=' . urlencode($row['probid']) .
			     '&amp;cmd=viewtext"><img src="../images/' . urlencode($row['problemtext_type']) .
			     '.png" alt="problem text" /></a></td>';
		} else {
			echo '<td></td>';
		}
		if ( IS_ADMIN ) {
			echo '<td title="export problem as zip-file">' .
			     exportLink($row['probid']) . '</td>' .
			     "<td class=\"editdel\">" .
			     editLink('problem', $row['probid']) . "&nbsp;" .
			     delLink('problem','probid',$row['probid']) . "</td>";
		}
		echo "</tr>\n";
	}
	echo "</tbody>\n</table>\n\n";
}

if ( IS_ADMIN ) {
	echo "<p>" . addLink('problem') . "</p>\n\n";
	if ( class_exists("ZipArchive") ) {
		$contests = $DB->q("KEYVALUETABLE SELECT cid,
		                    CONCAT('c', cid, ': ', shortname, ' - ', name) FROM contest");
		$values = array(-1 => 'Do not link to a contest');
		foreach ($contests as $cid => $contest) {
			$values[$cid] = $contest;
		}
		echo "\n" . addForm('problem.php', 'post', null, 'multipart/form-data') .
		     '<h2 style="font-size: 20px;" class="title-scoreboard flow-text">Choose contest below:</h2> ' .'<div style="width: 50%;">'.
		     addSelect('contest', $values, -1, true) .'</div>'.
		     'Problem archive(s): ' .
		     '<div style="width: 50%" class="file-field input-field">
			      <div class="btn">
			        <span>File</span>
			        '.addFileField('problem_archive[]', null, ' required multiple accept="application/zip"').
			      '</div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>'.
		     // addFileField('problem_archive[]', null, ' required multiple accept="application/zip"') .
		     addSubmit('Upload', 'upload') .
		     addEndForm() . "\n";
	}
}
echo '</div>';
require(LIBWWWDIR . '/footer.php');
