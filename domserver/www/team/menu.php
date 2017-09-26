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
            <li class="ct-nav">
                <!-- <a class="waves-effect waves-light" href="index.php" accesskey="h">Home</a> -->
                <a target="_top" href="index.php" accesskey=\"o\">overview</a>
            </li>
            <li class="ct-nav">
            	<!-- <?php	//if ( checkrole('balloon') ) { ?>
				<a href="balloons.php" accesskey="b">balloons</a> -->
				<?php	//} 
					if ( have_problemtexts() ) {
						echo "<a target=\"_top\" href=\"problems.php\" accesskey=\"t\">problems</a>\n";
					}
				?>

			</li>
			<li class="ct-nav">	
				<!-- <?php	//if ( checkrole('jury') ) { ?>
				<a href="problems.php" accesskey="p">problems</a>
				<?php	//} 
					if ( have_printing() ) {
						echo "<a target=\"_top\" href=\"print.php\" accesskey=\"p\">print</a>\n";
					}
				?> -->
			</li>
			<li class="ct-nav">	
				<a target="_top" href="scoreboard.php" accesskey="b">scoreboard</a>
			</li>
			<li class="ct-nav">		
				<?php
					if ( checkrole('jury') || checkrole('balloon') ) {
						echo "<a target=\"_top\" href=\"../jury/\" accesskey=\"j\">→jury</a>\n";
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





<?php

echo "</div>\n\n<div id=\"menutopright\">\n";

putClock();

echo "</div>\n\n";
