<nav class="light-blue" role="navigation">
    <div class="nav-wrapper">
      <div class="row">
      <!-- Logo -->
      	<div class="col s3">
            <a id="logo-container" href="index.php" accesskey="h" class="brand-logo waves-effect waves-light">Ued coder</a>
      	</div>
		      <div class="col s6 ct-menu">
          <!-- for destop -->
          <ul class="right hide-on-med-and-down">
            <li class="ct-nav">
                <a class="waves-effect waves-light" href="index.php" accesskey="h">Trang chủ</a>
            </li>
            
            <li class="ct-nav">
                <?php         
            		if ( have_problemtexts() ) {
      					echo "<a class=\"waves-effect waves-light\" href=\"problems.php\" accesskey=\"p\">Bài tập</a>\n";
      					}
      					logged_in(); // fill userdata
      					if ( checkrole('team') ) {
      						echo "<a class=\"waves-effect waves-light\" target=\"_top\" href=\"../team/\" accesskey=\"t\">→team</a>\n";
      					}
      					if ( checkrole('jury') || checkrole('balloon') ) {
      						echo "<a class=\"waves-effect waves-light\" target=\"_top\" href=\"../jury/\" accesskey=\"j\">→jury</a>\n";
      					}
    				?>
    			</li>
          </ul>

          </div>
          <!-- ./col s6 -->
          <div class="col s2 offset-s1 waves-effect waves-light">
              <ul>
                <li>
                    <a class="ct-login"  href="login.php" accesskey="l"><i class="material-icons">person_pin</i></a>
                </li>
                <li>
                    <?php
                        if ( !logged_in() ) {
                    ?> 
                      <a title="Đăng nhập" class="ct-login ct-menu" href="login.php" >
                      Đăng nhập</a>
                    <?php  
                        }
                    ?>
                </li>
              </ul>
          </div>
          <!-- ./s2 -->
	   </div>
     <!-- ./row -->
    </div>
    <!-- ./nav-wrapper -->
</nav>
<!-- ./navbar -->


