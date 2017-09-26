<nav class="light-blue" role="navigation">
    <div class="nav-wrapper">
      <div class="row">
      <!-- Logo -->
      	<div class="col s2">
            <a id="logo-container" href="index.php" accesskey="h" class="brand-logo waves-effect waves-light">Ued coder</a>
      	</div>
		      <div class="col s10 ct-menu">
          <!-- for destop -->
          <ul class="right hide-on-med-and-down">
          	<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/index.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
            <!-- <li class="ct-nav"> -->
                <a class="waves-effect waves-light" href="index.php" accesskey="h">Home</a>
            </li>
            <?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/balloons.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
            <!-- <li class="ct-nav"> -->
            	<?php	if ( checkrole('balloon') ) { ?>
				<a href="balloons.php" accesskey="b">balloons</a>
				<?php	} ?>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/problems.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<?php	if ( checkrole('jury') ) { ?>
				<a href="problems.php" accesskey="p">problems</a>
				<?php	} ?>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/judgehosts.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<?php	if ( IS_ADMIN ) {
					$ndown = count($updates['judgehosts']);
					if ( $ndown > 0 ) { ?>
				<a class="new" href="judgehosts.php" accesskey="j" id="menu_judgehosts">judgehosts (<?php echo $ndown ?> down)</a>
				<?php	} else { ?>
				<a href="judgehosts.php" accesskey="j" id="menu_judgehosts">judgehosts</a>
				<?php	}
					} ?>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/teams.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">		 -->
				<?php	if ( checkrole('jury') ) { ?>
				<a href="teams.php" accesskey="t">teams</a>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/users.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<a href="users.php" accesskey="u">users</a>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/clarifications.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<?php
					$nunread = count($updates['clarifications']);
					if ( $nunread > 0 ) { ?>
				<a class="new" href="clarifications.php" accesskey="c" id="menu_clarifications">clarifications (<?php echo $nunread ?> new)</a>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/clarifications.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<?php	} else { ?>
				<a href="clarifications.php" accesskey="c" id="menu_clarifications">clarifications</a>
				<?php	} ?>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/submissions.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">		 -->
				<a href="submissions.php" accesskey="s">submissions</a>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/rejudgings.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<?php
					$nrejudgings = count($updates['rejudgings']);
					if ( $nrejudgings > 0 ) { ?>
					
				<a class="new" href="rejudgings.php" accesskey="r" id="menu_rejudgings">rejudgings (<?php echo $nrejudgings ?> active)</a>
				<?php	} else { ?>
				<a href="rejudgings.php" accesskey="r" id="menu_rejudgings">rejudgings</a>
				<?php	} ?>
			</li>	
				<?php   } /* checkrole('jury') */ ?>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/print.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav">	 -->
				<?php	if ( have_printing() ) { ?>
				<a href="print.php" accesskey="p">print</a>
				<?php	} ?>
			</li>
			<?php 
          	if ($_SERVER["REQUEST_URI"] == '/domjudge/jury/scoreboard.php') 
          		echo '<li class="ct-nav active">'; 
          	else
          		echo '<li class="ct-nav">'; 				
            ?>
			<!-- <li class="ct-nav"> -->
				<?php	if ( checkrole('jury') ) { ?>
				<a href="scoreboard.php" accesskey="b">scoreboard</a>
				<?php	} ?>
			</li>
			
			<li class="ct-nav">	
				<?php
				if ( checkrole('team') ) {
					echo "<a target=\"_top\" href=\"../team/\" accesskey=\"t\">→team</a>\n";
				}
				?>
    		</li>
          </ul>

          </div>
          <!-- ./col s6 -->
          
	   </div>
     <!-- ./row -->
    </div>
    <!-- ./nav-wrapper -->
</nav>
<!-- ./navbar -->



<div id="menutopright">
<?php

putClock();

$notify_flag  =  isset($_COOKIE["domjudge_notify"])  && (bool)$_COOKIE["domjudge_notify"];
$refresh_flag = !isset($_COOKIE["domjudge_refresh"]) || (bool)$_COOKIE["domjudge_refresh"];
echo "<div class='container'>";
echo "<div id=\"row toggles\">\n";
if ( isset($refresh) ) {
	echo '<div style="margin-left: 30px;" class="col s2 right">';
	echo addForm('toggle_refresh.php', 'get') .
	    addHidden('enable', ($refresh_flag ? 0 : 1)) .
		// '<a class="waves-effect waves-light btn">'.
	    addSubmit(($refresh_flag ? 'Dis' : 'En' ) . 'able refresh', 'toggle_refresh') .
	    // '</a>'.
	    addEndForm();
		echo "</div>";	

}

// Default hide this from view, only show when javascript and
// notifications are available:
echo '<div class="col s2 right" id="notify" style="display: none">' .
	addForm('toggle_notify.php', 'get') .
	addHidden('enable', ($notify_flag ? 0 : 1)) .
	// '<a class="waves-effect waves-light btn">'.
	addSubmit(($notify_flag ? 'Dis' : 'En' ) . 'able notifications', 'toggle_notify',
	          'return toggleNotifications(' . ($notify_flag ? 'false' : 'true') . ')') .
	// '</a>'.
	addEndForm() . "</div>";

echo "</div>";	

?>
<script type="text/javascript">
<!--
    if ( 'Notification' in window ) {
		document.getElementById('notify').style.display = 'block';
	}
// -->
</script>

</div>

