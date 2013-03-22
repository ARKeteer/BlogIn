<!DOCTYPE html>
<?php
	ob_start();
	require_once("includes/UserClass.php");
	$auth = new Auth();
	$check=$auth->checkSession();
	if($check == 0) {
		header("Location: index.php");
		exit;
	}
	ob_end_clean();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BlogIn : Create new Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="/assets/ico/favicon.png">
  </head>

  <body>
	<!-- DO NOT EDIT THIS DIV -->
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
            <p class="navbar-text pull-right">
				<img src="/assets/img/examples/browser-icon-chrome.png" height="30" width="30" class="img-circle"></img>
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about" role="button" data-toggle="modal">About</a></li>
              <li><a href="#contact" role="button" data-toggle="modal">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <!-- Do not edit this div except marking any list item as active -->
		<div class="span3 affix">
          <div class="well sidebar-nav">
            <ul class="nav nav-list bs-docs-sidenav">
				<li><a href="dashboard.php">Overview</a></li>
				<li class="nav-header">Settings</li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="readlist.php">Reading list</a></li>
				<li class="nav-header">Your blogs</li>
				<li class="active"><a href="#">Create new blog</a></li>
				<li><a href="#">Blog 1</a></li>
				<li><a href="#">Blog 2</a></li>
				<li><a href="#">Blog 3</a></li>
				<li><a href="#">Blog 4</a></li>
				<li><a href="#">Blog 5</a></li>
				<li><a href="#">Blog 6</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9 well pull-right">
            <h2>Create new blog</h2>
        </div><!--/span-->
		<div class="span9 well pull-right">
            <form class="form-horizontal well" action="blognew.php" method="POST">
				<fieldset>
					<legend>Details for new blog</legend>
					<div class="control-group <?php if(isset($_GET['error'])) echo 'error'; ?>">
						<label class="control-label" for="input01">Blog name</label>
						<div class="controls">
							<input type="text" class="input span5" id="input01" name="blogname"/>
							<?php if(isset($_GET['error'])) echo '<span class="help-inline">Seems like blog name is not available.</span>'; ?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="select01">Choose layout</label>
						<div class="controls">
							<select id="select01" class="span5" name="layout">
								<option value="2">Widgets at right</option>
								<option value="1">Widgets at left</option>
								<option value="3">Widgets at bothsides</option>
								<option value="0">No widgets</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="textarea">Blog description</label>
						<div class="controls">
							<textarea class="input-xlarge span9" id="textarea" rows="5" name="blog_desc"></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Create &raquo;</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				</fieldset>
			</form>
        </div>
      </div><!--/row-->

      <hr>

<!-- DO NOT EDIT BELOW -->

      <footer>
        <p>&copy; MSU IT students 2013</p>
      </footer>

    </div><!--/.fluid-container-->

	
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
