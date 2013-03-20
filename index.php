<!DOCTYPE html>
<?php
	ob_start();
	require_once('includes/UserClass.php');
	$auth = new Auth();
	$check = $auth->checkSession();
	if($check == 1) {
		header("Location: dashboard.php");
		exit;
	}
	ob_end_clean();
?>
<html lang="en">
  <head>
	<meta charset="utf-8">
    <title>BlogIn : Next generation blogging site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">BlogIn</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about" role="button" data-toggle="modal">About</a></li>
              <li><a href="#contact" role="button" data-toggle="modal">Contact</a></li>
			  <li>
				<form class="form-search navbar-form">
					<input type="text" class="span2 search-query" placeholder="Find blogs">
					<!--<button type="submit" class="btn btn-primary">Search</button> -->
				</form>
			  </li>
            </ul>
            <form class="navbar-form pull-right" method="post" action="login.php">
				<input class="span2" name="email" type="email" placeholder="Email" required>
				<input class="span2" name="password" type="password" placeholder="Password" required>
				<button type="submit" class="btn btn-primary">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
<?php if(isset($_GET['login'])) {
echo '<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Success!</strong> Please login to continue.</div> ';
}
?>
<?php if(isset($_GET['logfail'])) {
echo '<div class="alert alert-error fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error!</strong> It seems that you did some serious mistake.</div> ';
}
?>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit">
        <h2>Hello, world!</h2>
        <p>Welcome to next generation blogging site. Get your blog right now in 3 simple steps</p>
		<ol>
			<li>Create Account</li>
			<li>Create new blog</li>
			<li>Start posting</li>
		</ol>
        <p><a class="btn btn-primary" href="#signup" role="button" data-toggle="modal" ><i class="icon-user icon-white"> </i>&nbsp;Sign up now &raquo;</a></p>
      </div>


      <hr>

      <footer>
        <p>&copy; MSU IT students 2013</p>
      </footer>

    </div> <!-- /container -->
	
	<!-------------------------------------------------------------------------------->
	<!--						Signup dialog box design.							-->
	<!-------------------------------------------------------------------------------->

	<div id="signup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Please Fill in details.</h3>
		</div>
		<div class="modal-body well">
			<form class="form-horizontal well" method="post" action="signup.php" name="signup">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="input01">Name</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="input01" name="name">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label h3" for="input02">Email</label>
						<div class="controls">
							<input type="email" class="input-xlarge" id="input02" name="email">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label h3" for="input03">Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge" id="input03" name="password">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label h3" for="input04">Retype Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge" id="input04" name="retype_paswwd">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label h3" for="captcha">Captcha</label>
						<div id="captcha" class="controls">
							<?php
								require_once('includes/recaptchalib.php');
								$publickey = "6Lce-t0SAAAAACVtYmr4YtkqiS_BMl1JqjJDisC3"; // you got this from the signup page
								echo recaptcha_get_html($publickey);
							?>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
			<button class="btn btn-primary" onclick="signup.submit();">Sign up</button>
		</div> 
	</div>
	
	<!-------------------------------------------------------------------------------->
	<!--						About dialog box design.							-->
	<!-------------------------------------------------------------------------------->
	
	<div id="about" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="aboutLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="aboutLabel">About</h3>
		</div>
		<div class="modal-body well">
			<blockquote>
				<p>A blog (a portmanteau of the term web log) is a discussion or informational site published on the World Wide Web and consisting of discrete entries typically displayed in reverse chronological order.</p>
				<small>Wikipedia</small>
			</blockquote>
			
			<p>Here we introduce easier blogging site! As described in just 3 simple steps you can easily create your own blog with us</p>
			<p>Our reference for this blogging site was Blogger, Wordpress and Tumblr.</p>
			<p>Thanks to Twitter for bootstrap library, our project guide : Mr. Parth Gandhi, and Others..</p>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close this dialog</button>
		</div> 
	</div>
	
	<!-------------------------------------------------------------------------------->
	<!--						Contact dialog box design.							-->
	<!-------------------------------------------------------------------------------->
	
	<div id="contact" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="contactLabel">Contact us</h3>
		</div>
		<div class="modal-body well">
			<p>Bhushan Shah : <a href="mailto:bhush94@gmail.com">bhush94@gmail.com</a>
			<p>Aazam Khatri : <a href="mailto:aazam.khatri@gmail.com">aazam.khatri@gmail.com</a>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Okay</button>
		</div> 
	</div>


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap-transition.js"></script>
    <script src="/assets/js/bootstrap-alert.js"></script>
    <script src="/assets/js/bootstrap-modal.js"></script>
    <script src="/assets/js/bootstrap-dropdown.js"></script>
    <script src="/assets/js/bootstrap-scrollspy.js"></script>
    <script src="/assets/js/bootstrap-tab.js"></script>
    <script src="/assets/js/bootstrap-tooltip.js"></script>
    <script src="/assets/js/bootstrap-popover.js"></script>
    <script src="/assets/js/bootstrap-button.js"></script>
    <script src="/assets/js/bootstrap-collapse.js"></script>
    <script src="/assets/js/bootstrap-carousel.js"></script>
    <script src="/assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
