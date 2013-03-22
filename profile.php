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
    <title>BlogIn : Profile</title>
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
	<script language="javascript">
		function unlock() {
			document.getElementById('input05').disabled=false;
			document.getElementById('input04').disabled=false;
			document.getElementById('input03').disabled=false;
			document.getElementById('input02').disabled=false;
			document.getElementById('input06').disabled=false;
			document.getElementById('textarea').disabled=false;
			document.getElementById('quest').disabled=false;
			document.getElementById('ans').disabled=false;
		}
		
		function lock() {
			document.getElementById('input05').disabled=true;
			document.getElementById('input04').disabled=true;
			document.getElementById('input03').disabled=true;
			document.getElementById('input02').disabled=true;
			document.getElementById('input06').disabled=true;
			document.getElementById('textarea').disabled=true;
			document.getElementById('quest').disabled=true;
			document.getElementById('ans').disabled=true;
		}
		
		function toggle() {
			if(document.getElementById('input02').disabled == false) {
				lock();
				document.getElementById('key').innerHTML="<i class='icon-lock'></i> Unlock";
			}                                  
			else {                             
				unlock();                      
				document.getElementById('key').innerHTML="<i class='icon-lock'></i> Lock";
			}
		}
	</script>
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
            <p class="navbar-text pull-right">
				<img src="/assets/img/examples/browser-icon-chrome.png" height="30" width="30" class="img-circle"></img>
              Logged in as <a href="#" class="navbar-link"><?php echo $auth->getUser(); ?></a>
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
        <div class="span3 affix">
          <div class="well sidebar-nav">
            <ul class="nav nav-list bs-docs-sidenav">
				<li><a href="dashboard.php">Overview</a></li>
				<li class="nav-header">Settings</li>
				<li class="active"><a href="profile.php">Profile</a></li>
				<li><a href="readlist.php">Reading list</a></li>
				<li class="nav-header">Your blogs</li>
				<li><a href="newblog.php">Create new blog</a></li>
				<li><a href="#">Blog 1</a></li>
				<li><a href="#">Blog 2</a></li>
				<li><a href="#">Blog 3</a></li>
				<li><a href="#">Blog 4</a></li>
				<li><a href="#">Blog 5</a></li>
				<li><a href="#">Blog 6</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9 pull-right well">
            <h2>Your Profile</h2>
        </div><!--/span-->
		<?php if(isset($_GET['done'])) echo '<div class="span9 pull-right alert alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button><strong>Success!</strong> Your changes are preserved.</div>'; ?>
		<div class="span9 pull-right well">
			<div class="span3 pull-right well">
				<button class="btn btn-primary" onclick="toggle()" id="key"><i class="icon-lock"></i> Unlock</button>
			</div>
            <form class="form-horizontal" action="update.php" method="POST">
				<fieldset>
					<legend>Edit Profile</legend>		
					<div class="control-group">
						<label class="control-label" for="input05">First name</label>
						<div class="controls">
							<input type="text" class="input-xlarge span7" name="fname" id="input05" value="<?php echo $auth->getUser(); ?>" disabled></input>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input06">Last name</label>
						<div class="controls">
							<input type="text" class="input-xlarge span7" name="lname" id="input06" value="<?php echo $auth->getlname(); ?>"disabled></input>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input02">Email</label>
						<div class="controls">
							<input type="email" class="input-xlarge span7" name="email" id="input02" value="<?php echo $auth->getEmail(); ?>" disabled></input>						
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input03">Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge span7" name="password" id="input03" onchange="document.getElementById('input04').disabled=false" disabled></input>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input04">Retype Password</label>
						<div class="controls">
							<input type="password" class="input-xlarge span7" id="input04" disabled></input>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input07">Bio</label>
						<div class="controls">
							<textarea class="input-xlarge span7" id="textarea" rows="5" name="bio" disabled><?php echo $auth->getBio(); ?></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
				</fieldset>
			</form>
        </div>
		<div class="span9 pull-right well">
			<form class="form-horizontal" action="savequestion.php" method="POST">
				<fieldset>
				
					<legend>Security Question for password recovery</legend>
					<div class="control-group">
						<label class="control-label" for="input05">Desired question</label>
						<div class="controls">
							<input type="text" class="input-xlarge span7" name="quest" id="quest" value="" disabled></input>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="input06">Answer</label>
						<div class="controls">
							<input type="text" class="input-xlarge span7" name="ans" id="ans" value=""disabled></input>
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save</button>
						<button type="reset" class="btn">Cancel</button>
					</div>
					
				</fieldset>
			</form>
		</div>
      </div><!--/row-->

      <hr>

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
