<?php
/**
 * Generated from 'relations.php.in' on Sun Feb 12 16:26:27 BRST 2017.
 *
 * Document relations between DOMjudge tables for various use.
 * The data is extracted fromt the SQL DB structure file.
 */

/** For each table specify the set of attributes that together
 *  are considered the primary key / superkey. */
$KEYS = array(
// @KEYS@
	'auditlog' => array('logid'),
	'balloon' => array('balloonid'),
	'clarification' => array('clarid'),
	'configuration' => array('configid'),
	'contest' => array('cid'),
	'contestproblem' => array('cid','probid'),
	'contestteam' => array('teamid','cid'),
	'event' => array('eventid'),
	'executable' => array('execid'),
	'judgehost' => array('hostname'),
	'judgehost_restriction' => array('restrictionid'),
	'judging' => array('judgingid'),
	'judging_run' => array('runid'),
	'language' => array('langid'),
	'problem' => array('probid'),
	'rankcache_jury' => array('cid','teamid'),
	'rankcache_public' => array('cid','teamid'),
	'rejudging' => array('rejudgingid'),
	'role' => array('roleid'),
	'scorecache_jury' => array('cid','teamid','probid'),
	'scorecache_public' => array('cid','teamid','probid'),
	'submission' => array('submitid'),
	'submission_file' => array('submitfileid'),
	'team' => array('teamid'),
	'team_affiliation' => array('affilid'),
	'team_category' => array('categoryid'),
	'team_unread' => array('teamid','mesgid'),
	'testcase' => array('testcaseid'),
	'user' => array('userid'),
	'userrole' => array('userid', 'roleid'),
);

/** For each table, list all attributes that reference foreign keys
 *  and specify the source of that key. Appended to the
 *  foreign key is '&<ACTION>' where ACTION can be any of the
 *  following referential actions on delete of the foreign row:
 *  CASCADE:  also delete the source row
 *  SETNULL:  set source key to NULL
 *  RESTRICT: disallow delete of foreign row
 *  NOCONSTRAINT: no constraint is specified, even though the field
 *                references a foreign key.
 */
$RELATIONS = array(
// @RELATIONS@
	'auditlog' => array(
	),

	'balloon' => array(
		'submitid' => 'submission.submitid&CASCADE',
	),

	'clarification' => array(
		'cid' => 'contest.cid&CASCADE',
		'respid' => 'clarification.clarid&SETNULL',
		'probid' => 'problem.probid&SETNULL',
	),

	'configuration' => array(
	),

	'contest' => array(
	),

	'contestproblem' => array(
		'cid' => 'contest.cid&CASCADE',
		'probid' => 'problem.probid&CASCADE',
	),

	'contestteam' => array(
		'cid' => 'contest.cid&CASCADE',
		'teamid' => 'team.teamid&CASCADE',
	),

	'event' => array(
		'cid' => 'contest.cid&CASCADE',
		'clarid' => 'clarification.clarid&CASCADE',
		'langid' => 'language.langid&CASCADE',
		'probid' => 'problem.probid&CASCADE',
		'submitid' => 'submission.submitid&CASCADE',
		'judgingid' => 'judging.judgingid&CASCADE',
		'teamid' => 'team.teamid&CASCADE',
	),

	'executable' => array(
	),

	'judgehost' => array(
		'restrictionid' => 'judgehost_restriction.restrictionid&SETNULL',
	),

	'judgehost_restriction' => array(
	),

	'judging' => array(
		'cid' => 'contest.cid&CASCADE',
		'submitid' => 'submission.submitid&CASCADE',
		'judgehost' => 'judgehost.hostname&SETNULL',
		'rejudgingid' => 'rejudging.rejudgingid&SETNULL',
		'prevjudgingid' => 'judging.judgingid&SETNULL',
	),

	'judging_run' => array(
		'testcaseid' => 'testcase.testcaseid&RESTRICT',
		'judgingid' => 'judging.judgingid&CASCADE',
	),

	'language' => array(
	),

	'problem' => array(
	),

	'rankcache_jury' => array(
		'cid' => 'contest.cid&CASCADE',
	),

	'rankcache_public' => array(
		'cid' => 'contest.cid&CASCADE',
	),

	'rejudging' => array(
		'userid_start' => 'user.userid&SETNULL',
		'userid_finish' => 'user.userid&SETNULL',
	),

	'role' => array(
	),

	'scorecache_jury' => array(
	),

	'scorecache_public' => array(
	),

	'submission' => array(
		'cid' => 'contest.cid&CASCADE',
		'teamid' => 'team.teamid&CASCADE',
		'probid' => 'problem.probid&CASCADE',
		'langid' => 'language.langid&CASCADE',
		'judgehost' => 'judgehost.hostname&SETNULL',
		'origsubmitid' => 'submission.submitid&SETNULL',
		'rejudgingid' => 'rejudging.rejudgingid&SETNULL',
	),

	'submission_file' => array(
		'submitid' => 'submission.submitid&CASCADE',
	),

	'team' => array(
		'categoryid' => 'team_category.categoryid&CASCADE',
		'affilid' => 'team_affiliation.affilid&SETNULL',
	),

	'team_affiliation' => array(
	),

	'team_category' => array(
	),

	'team_unread' => array(
		'teamid' => 'team.teamid&CASCADE',
		'mesgid' => 'clarification.clarid&CASCADE',
	),

	'testcase' => array(
		'probid' => 'problem.probid&CASCADE',
	),

	'user' => array(
		'teamid' => 'team.teamid&SETNULL',
	),

	'userrole' => array(
		'userid' => 'user.userid&CASCADE',
		'roleid' => 'role.roleid&CASCADE',
	),

);

// Additional relations not encoded in the SQL structure:
$RELATIONS['clarification']['sender']    = 'team.teamid&NOCONSTRAINT';
$RELATIONS['clarification']['recipient'] = 'team.teamid&NOCONSTRAINT';

foreach ( array('jury','public') as $type ) {
	$RELATIONS['rankcache_'.$type]['teamid'] = 'team.teamid&NOCONSTRAINT';

	$RELATIONS['scorecache_'.$type]['cid'] = 'contest.cid&NOCONSTRAINT';
	$RELATIONS['scorecache_'.$type]['teamid'] = 'team.teamid&NOCONSTRAINT';
	$RELATIONS['scorecache_'.$type]['probid'] = 'problem.probid&NOCONSTRAINT';
}


/**
 * Check whether some primary key is referenced in any
 * table as a foreign key.
 *
 * Returns null or an array "table name => action" where matches are found.
 */
function fk_check ($keyfield, $value) {
	global $RELATIONS, $DB;

	$ret = array();
	foreach ( $RELATIONS as $table => $keys ) {
		foreach ( $keys as $key => $val ) {
			@list( $foreign, $action ) = explode('&', $val);
			if ( empty($action) ) $action = 'CASCADE';
			if ( $foreign == $keyfield ) {
				$c = $DB->q("VALUE SELECT count(*) FROM $table WHERE $key = %s", $value);
				if ( $c > 0 ) $ret[$table] = $action;
			}
		}
	}

	if ( count($ret) ) return $ret;
	return null;
}
