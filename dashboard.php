<!DOCTYPE html>
<?php
	ob_start();
	require_once("includes/UserClass.php");
	require_once("includes/BlogClass.php");
	$auth = new Auth();
	$blog = new Blog();
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
    <title>BlogIn : Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      
    </style>
    <link href="../../assets/css/bootstrap-responsive.css" rel="stylesheet">

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
			<img src="<?php $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($auth->getEmail())))."?s=30"; echo $grav_url; ?>" height="30" width="30"></img>
            Logged in as <a href="#" class="navbar-link"><?php echo $auth->getUser(); ?></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about" role="button" data-toggle="modal">About</a></li>
              <li><a href="#contact" role="button" data-toggle="modal">Contact</a></li>
              <li><a href="logout.php" role="button">Logout</a></li>
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
				<li class="active"><a href="#">Overview</a></li>
				<li class="nav-header">Settings</li>
				<li><a href="profile.php">Profile</a></li>
				<li class="nav-header">Your blogs</li>
				<li><a href="newblog.php">Create new blog</a></li>
				<?php
					$result=$blog->getallblogs();
					while($row = mysqli_fetch_array($result))
					{
						echo '<li><a href="/'.$row['b_name'].'">'.$row['b_name']."</a></li>";
					}
				?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9 well pull-right" data-spy="affix" data-offset-top="200">
            <h2>Dashboard</h2>
        </div><!--/span-->
		<div class="span9 pull-right well">
			<div class="row-fluid">
				<div class="span9">
					<h3>Your profile</h3>
				</div>
				<div class="span3">
					<br>
					<a class="btn btn-primary pull-right" href="profile.php">Edit profile</a>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span2">
					<img src="<?php $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($auth->getEmail())))."?s=127"; echo $grav_url; ?>" align="center" height="126" width="126" border="1"></img></br>
				</div>
				<div class="span8">
					<div class="pull-left">
						<p>Name : <?php echo $auth->getUser()." ".$auth->getLname(); ?></p>
						<p>Email : <?php echo $auth->getEmail(); ?></p>
						<p><?php echo $auth->getBio(); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
			$result=$blog->getallblogs();
			while($row = mysqli_fetch_array($result))
			{
				echo '<div class="span9 pull-right well">';
				echo '<div class="row-fluid">';
				echo '<div class="span9">';
				echo '<h3>'.$row["b_name"].'</h3>';
				echo '</div>';
				echo '<div class="span3">';
				echo '<br>';
				echo '<a class="btn btn-primary pull-right" href="'.$row['b_name'].'/settings.php">Edit settings</a>';
				echo '</div>';
				echo '</div>';
				echo '<div class="tabbable" id="'.$row['b_name'].'"> <!-- Only required for left/right tabs -->';
				echo '<ul class="nav nav-pills">';
				echo '<li class="active"><a href="#'.$row['b_name'].'_tab1" data-toggle="tab">Stats</a></li>';
				echo '<li><a href="#'.$row['b_name'].'_tab2" data-toggle="tab">Comments</a></li>';
				echo '</ul>';
				echo '<div class="tab-content">';
				echo '<div class="tab-pane active" id="'.$row['b_name'].'_tab1">';
				echo '<p>Your new pageviews and graphs go here.</p>';
				echo '</div>';
				echo '<div class="tab-pane" id="'.$row['b_name'].'_tab2">';
				echo '<p>New and First 3 comments will go here.</p>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
		?>
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
    <script src="/assets/js/holder/holder.js"></script>

  </body>
</html>