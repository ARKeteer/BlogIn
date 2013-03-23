<!DOCTYPE html>
<?php
	ob_start();
	require_once("../includes/UserClass.php");
	require_once("../includes/PostClass.php");
	require_once("../includes/BlogClass.php");
	require_once("../includes/CommentClass.php");
	require_once("../includes/markdown.php");
	require_once("config.php");
	
	$auth = new Auth();
	$post = new Post();
	$blog = new Blog();
	$comment = new Comment();
	$thisblog = new BlogConfig();
	$name=$thisblog->getBid();
	$id=$blog->getID($name);
	
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $name; ?></title>
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
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../../assets/ico/favicon.png">
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
<!--			<form class="navbar-form pull-right" method="post" action="login.php">
				<input class="span2" name="email" type="email" placeholder="Email" required>
				<input class="span2" name="password" type="password" placeholder="Password" required>
				<button type="submit" class="btn btn-primary">Sign in</button>
            </form>-->
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
		<div class="hero-unit">
			<h2><?php echo $blog->getName(mysql_real_escape_string($id)); ?></h2>
			<p><?php echo $blog->getAbout(mysql_real_escape_string($id)); ?></p>
		</div>
		<div class="row-fluid">
			<!-- Do not edit this div except marking any list item as active -->
			<div class="span9 well pull-left">
				<?php
					$row=$post->getpost(mysql_real_escape_string($_GET['id']));
					if($row['parent_blog']==$id) {
						echo "<h3><a href='post.php?id=".$row['post_id']."'>".$row['post_title']."</a></h3><div class='pull-right'>".$row['post_date']." ".$row['post_time']."</div>"."<hr>";
						echo Markdown($row['post_data']."<br>");
					}
					else
					{
						echo 'Something wired happend! May be 404 not found?!';
					}
				?>
				<br><br>
				<hr>
				<?php
				$result=$comment->getComments($_GET['id']);
				while($row = mysqli_fetch_array($result))
				{
					echo '<div class="media">';
					echo '<a class="pull-left">';
					echo '<img class="media-object" alt="64x64" style="width: 64px; height: 64px;" src="'."http://www.gravatar.com/avatar/".md5(strtolower(trim($auth->getEmail($row["poster_id"]))))."?s=64".'">';
					echo '</a>';
					echo '<div class="media-body">';
					echo '<h4 class="media-heading">'.$auth->getFullName($row["poster_id"]).'</h4>';
					echo $row['comment_data'];
					echo '</div>';
					echo '</div><hr>';
				}
				?>
				<form class="form-block" action="addcomment.php" method="POST">
					<fieldset>
						<div class="control-group">
							<div class="controls">
								<textarea class="input-xlarge span9" id="textarea" rows="5" name="comment_data" style="margin: 0px 0px 10px; width: 870px; height: 125px;"></textarea>
								<input type="hidden" value="<?php echo $_GET['id']; ?>" name="postid"></input>
								<button type="submit" class="btn btn-primary">Create Comment &raquo;</button>
								<button type="reset" class="btn">Cancel</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 well pull-right">
				Widget1<br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div><!--/span-->
			<div class="span3 well pull-right">
				<!-- Content will Go here -->
				Widget2<br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div><!--/row-->
		<ul class="pager">
			<li class="next">
				<a href="#" class="btn btn-primary">Older &rarr;</a>
			</li>
			<li class="previous disabled">
				<a href="#" class="btn btn-primary">&larr; Newer</a>
			</li>
		</ul>
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
