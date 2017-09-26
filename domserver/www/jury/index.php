<?php
/**
 * Part of the DOMjudge Programming Contest Jury System and licenced
 * under the GNU GPL. See README and COPYING for details.
 */

$REQUIRED_ROLES = array('jury', 'balloon');
require('init.php');

$title = 'Jury interface';
require(LIBWWWDIR . '/header.php');

echo "<div class='container'>";

echo "<h1 class=\"title-scoreboard flow-text\">DOMjudge Jury interface</h1>\n\n";

if ( is_readable('../images/DOMjudgelogo.png') ) {
	echo "<p><a href=\"https://www.domjudge.org/\">" .
		// "<img src=\"../images/DOMjudgelogo.png\" id=\"djlogo\" " .
		// "alt=\"DOMjudge logo\" title=\"The DOMjudge logo: free as in beer!\" />
		"</a>
		</p>\n\n";
}

?>

<ul class="collapsible" data-collapsible="accordion">
	<li>
	  <div class="collapsible-header active" >
	  	<i class="material-icons">view_headline</i>Overviews
	  </div>
	  <div class="collapsible-body">
	  	<ul id="overviews">
			<li class="ct-list flow-text"><a href="balloons.php">
			<i class="fa fa-play" aria-hidden="true"></i>Balloon Status</a></li>
			<?php if ( checkrole('jury') ) { ?>
			<li class="ct-list flow-text"><a href="clarifications.php"><i class="fa fa-play" aria-hidden="true"></i>Clarifications</a></li>
			<li class="ct-list flow-text"><a href="contests.php"><i class="fa fa-play" aria-hidden="true"></i>Contests</a></li>
			<li class="ct-list flow-text"><a href="executables.php"><i class="fa fa-play" aria-hidden="true"></i>Executables</a></li>
			<li class="ct-list flow-text"><a href="judgehosts.php"><i class="fa fa-play" aria-hidden="true"></i>Jghosts</a></li>
			<li class="ct-list flow-text"><a href="judgehost_restrictions.php"><i class="fa fa-play" aria-hidden="true"></i>Judgehost Restrictions</a></li>
			<li class="ct-list flow-text"><a href="languages.php"><i class="fa fa-play" aria-hidden="true"></i>Languages</a></li>
			<li class="ct-list flow-text"><a href="problems.php"><i class="fa fa-play" aria-hidden="true"></i>Problems</a></li>
			<li class="ct-list flow-text"><a href="scoreboard.php"><i class="fa fa-play" aria-hidden="true"></i>Scoreboard</a></li>
			<li class="ct-list flow-text"><a href="statistics.php"><i class="fa fa-play" aria-hidden="true"></i>Statistics</a></li>
			<li class="ct-list flow-text"><a href="submissions.php"><i class="fa fa-play" aria-hidden="true"></i>Submissions</a></li>
			<li class="ct-list flow-text"><a href="users.php"><i class="fa fa-play" aria-hidden="true"></i>Users</a></li>
			<li class="ct-list flow-text"><a href="teams.php"><i class="fa fa-play" aria-hidden="true"></i>Teams</a></li>
			<li class="ct-list flow-text"><a href="team_categories.php"><i class="fa fa-play" aria-hidden="true"></i>Team Categories</a></li>
			<li class="ct-list flow-text"><a href="team_affiliations.php"><i class="fa fa-play" aria-hidden="true"></i>Team Affiliations</a></li>
			<?php } ?>
		</ul>
	  </div>
	</li>
	<li>
	  <div class="collapsible-header">
	  <i class="material-icons">assignment_ind</i>Administrator</div>
	  <div class="collapsible-body">
	  		<?php if ( IS_ADMIN ): ?>
			<ul id="administrator">
				<li class="ct-list flow-text"><a href="config.php"><i class="fa fa-play" aria-hidden="true"></i>Configuration settings</a></li>
				<li class="ct-list flow-text"><a href="checkconfig.php"><i class="fa fa-play" aria-hidden="true"></i>Config checker</a></li>
				<li class="ct-list flow-text"><a href="impexp.php"><i class="fa fa-play" aria-hidden="true"></i>Import / export</a></li>
				<li class="ct-list flow-text"><a href="genpasswds.php"><i class="fa fa-play" aria-hidden="true"></i>Manage team passwords</a></li>
				<li class="ct-list flow-text"><a href="refresh_cache.php"><i class="fa fa-play" aria-hidden="true"></i>Refresh scoreboard cache</a></li>
				<li class="ct-list flow-text"><a href="check_judgings.php"><i class="fa fa-play" aria-hidden="true"></i>Judging verifier</a></li>
				<li class="ct-list flow-text"><a href="auditlog.php"><i class="fa fa-play" aria-hidden="true"></i>Activity log</a></li>
			</ul>

			<?php endif; ?>	
	  </div>
	</li>
	<li>
	  <div class="collapsible-header" onclick="Materialize.showStaggeredList('#documentation')">
	  <i class="material-icons">library_books</i>Documentation</div>
	  <div class="collapsible-body">
			<ul id="documentation">
			<li class="ct-list flow-text"><a href="doc/judge/judge-manual.html"><i class="fa fa-play" aria-hidden="true"></i>Judge manual</a>
				(also <a href="doc/judge/judge-manual.pdf">PDF</a>)</li>
			<li class="ct-list flow-text"><a href="doc/admin/admin-manual.html"><i class="fa fa-play" aria-hidden="true"></i>Administrator manual</a>
				(also <a href="doc/admin/admin-manual.pdf">PDF</a>)</li>
			<li class="ct-list flow-text"><a href="doc/team/team-manual.pdf"><i class="fa fa-play" aria-hidden="true"></i>Team manual</a>
				(PDF only)</li>
			</ul>
	  </div>
	</li>
</ul>

<?php
echo '<p class="flow-text center-align row">';
putDOMjudgeVersion();
echo '</p>';

echo "</div>";

require(LIBWWWDIR . '/footer.php');
