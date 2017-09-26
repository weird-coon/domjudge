<?php
/**
 * Common page footer
 */
if (!defined('DOMJUDGE_VERSION')) die("DOMJUDGE_VERSION not defined.");

if ( DEBUG & DEBUG_TIMINGS ) {
	echo "<p>"; totaltime(); echo "</p>";
} ?>

<footer class="page-footer" style="background: #03A9F4; margin-bottom: 0px !important;">

    <div class="container" style="padding: 50px 0;position: relative;">
    	<a href="javascript:void(0);" class="page-scroll btn-floating btn-large pink back-top waves-effect waves-light tt-animate btt" data-section="#top">
      		<i class="material-icons"></i>
   		</a>
      <div class="row center-align">
        <div class="col l12">
          <div class="footer-logo">
            <a id="logo-container" href="javascript:void(0);" accesskey="h" class="back-top waves-effect waves-light">Ued coder</a>
          </div>
          <ul class="social-link tt-animate ltr">
            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-rss"></i></a></li>
          </ul>
        </div>
        
      </div>
    </div>
    <div class="footer-copyright" style="background: #0288d1 !important;">
      <div class="container center-align" style="padding: 27px 0;">
      	<span class="white-text">Copyright © 2017 <a class="light-blue-text text-lighten-5 ft-hover" href="#">Materialize</a> &nbsp;  | &nbsp;  All Rights Reserved &nbsp;  | &nbsp;  Developer By <a class="light-blue-text text-lighten-5 ft-hover" href="#">DattTeam</a></span>
      </div>
    </div>
  </footer>
  <!--  Scripts-->

  </body>
</html>
