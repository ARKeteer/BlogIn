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
    <title>BlogIn : Next generation blogging site</title>
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
				<img src="/assets/ico/apple-touch-icon-114-precomposed/examples/browser-icon-chrome.png" height="30" width="30"></img>
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
          <div class="well">
            <ul class="nav nav-list bs-docs-sidenav">
				<li class="nav-header">Posts</li>
				<li class="active"><a href="#">All posts</a></li>
				<li><a href="#">Add new</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="#">Tags</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9 well pull-right">
			<h2>Blog1</h2>
        </div><!--/span-->
		<div class="span9 well pull-right">
			<h3>Posts</h3>
			<form class ="form-inline">				   
				<select name="date">
					<option value="-1" selected="selected">
						Show all dates
					</option>
					<option name="php_gen">
						php generated dates
					</option>
				</select>
				<select name="Categories">
					<option value="-1" selected="selected">
						Show all Categories
					</option>
					<option name="php_gen">
						php generated Categories
					</option>
				</select>
				<button class="btn btn-primary">
					Filter
				</button>
			</form>
					
			<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th><input type="checkbox" id="select_all"</th>
				<th>Title</th>
				<th>Author</th>
				<th>Categories</th>
				<th>Tags</th>
				<th>Comment</th>
				<th>Date</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><input type="checkbox" id="check01"></td>
				<td>Hello</td>
				<td>Me</td>
				<td>Uncategorised</td>
				<td>-</td>
				<td>Bye</td>
				<td>April 2013</td>
			</tr>
			<tr>
				<td><input type="checkbox" id="check01"></td>
				<td>Hello</td>
				<td>Me</td>
				<td>Uncategorised</td>
				<td>-</td>
				<td>Bye</td>
				<td>April 2013</td>
			</tr>
		</tbody>
  </table>				
			<form class="form-inline">
				<select name= "action" >
					<option selected="selected" value="-1">
						Bulk Actions
					</option>
					<option value="edit">
						Edit
					</option>
					<option value="trash">
						Move to Trash
					</option>
				</select>
				<button class="btn btn-primary" type="submit">
					<!--<i class="icon-ok icon-white"></i>-->
					Apply
				</button>
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
