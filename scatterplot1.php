<?php
session_start();
include_once 'Security.php';

Security::instance()->require_login();

if(isset($_SESSION['user_email'])){
	$user_email=$_SESSION['user_email'];
}else{
	$user_email='guest';
} 

?>



<!DOCTYPE html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta http-equiv='Content-Language' content='el' />
		<!-- Website Title & Description for Search Engine purposes -->
		<title></title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

		<!-- Custom CSS -->
		<link href="includes/css/styles.css" rel="stylesheet">
		
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="includes/js/modernizr-2.6.2.min.js"></script>
		
		<title>Woldbank</title>
	</head>

<style>

body {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.bar {
  fill: steelblue;
}

.x.axis path {
  display: none;
}

</style>
<body>
	<div class="container" id="main"><!--this is bootstrap class-->
	<div class="navbar navbar-fixed-top"><!--navigation bar to stay on top and be visible every time this a bootstrap class-->
	<!--the navbar is independent from external container-->
		<div class="container"><!--container for the navbar-->
			<button class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Your logo"></a>

			<div class="nav-collapse collapse navbar-responsive-collapse">
				<ul class="nav navbar-nav"><!--unorder list-->
				<li class="active"><!--items inside unordered or ordered list active means that the button has more gray color-->
					<a href="index.php">Home</a>	
				</li>
				<li class="dropdown"><!--items inside unordered or ordered list-->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<strong class="caret"></strong></a>	
					<ul class="dropdown-menu">
						<li class="dropdown-header">
							Σχεδίαση Γραφημάτων
						</li>
						<li>
							<a href="barchart1.php" target="_self">Barchart ως προς Χώρα</a>
						</li>
						<li>
							<a href="barchart2.php" target="_self">Barchart ως προς Δείκτη</a>
						</li>
						<li>
							<a href="timeline.php" target="_self">Timeline</a>
						</li>
						<li>
							<a href="scatterplot.php" target="_self">Scatterplot</a>
						</li>

						<li class="divider">
						</li>
						<li class="dropdown-header">
							Μεταβολή Τιμών
						</li>
						<li>
							<a href="importdata.php" target="_self">Μεταβολή Τιμών</a>
						</li>
						<li class="divider">
						</li>
						<li class="dropdown-header">
							Αναφορές
						</li>
						<li>
							<a href="take.php" target="_self">Αναφορές</a>
						</li>
					</ul><!--end dropdown menu-->
				</li>
				
				</ul><!--end of the ul class-->

				<ul class="nav navbar-nav pull-right"><!--this is for my acount button-->
					<li class="dropdown">
						<?php
							echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> '.$user_email.' <strong class="caret"></strong></a>';
						?>

						<ul class="dropdown-menu">
							<li>
								<a href="#myModal" data-toggle="modal"><span class="glyphicon glyphicon-ok"></span> Είσοδος</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="logout.php"><span class="glyphicon glyphicon-off"></span> Έξοδος</a>
							</li>
						</ul>
					</li>	
				</ul><!--end nav pull-right-->
			</div><!--end of nav-collapse--> 
		</div><!--end of navbar-->	
	
	</div><!--end of navbar-->


<!---------------Start------------------>

	<div class="row" id="myjs">
		<div class="col-12 feature"><!--first col-->
			<div class="panel">
				<div class="panel-heading">
					<h1 class="panel-title">Γραφική Παράσταση Scatterplot</h1>	
				</div><!--end panel-heading-->
				<div class="panel-body">

<iframe src="scatterplotcore.php" height="500" width="1000" marginwidth="0" marginheight="0" scrolling="no">
</iframe>
<br><br>
			<div class="col-2 feature" id="mybottom"><!--bottom-->
			</div>

			<div class="col-8 feature" id="mybottom"><!--bottom-->
			<a href="take.php" target="_self" class="btn btn-primary btn-block">Επιστροφή</a>
			</div>

			<div class="col-2 feature" id="mybottom"><!--bottom-->
			</div>


				</div><!--end panel-body-->


			</div><!--end panel-->
		</div><!--end of col-sm-4-->
	</div><!--end of row features-->



<!-------------end----------------->





</div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<h6>Copyright &copy; 2014 <br> Aleiferis Christos, <br>Katsigiannis Theophilos,<br>Papadopoulos Konstantinos</h6>
				</div><!--end of col-sm-2-->
				<div class="col-sm-6">
					<h6>About Us</h6>
				<p>Είμαστε η ομάδα 1 του εργαστηρίου του μαθήματος “Προχωρημένα Θέματα Τεχνολογίας και Εφαρμογών Βάσεων Δεδομένων” αποτελούμενη από τους</p>
					<ul class="unstyled">
						<li>Αλειφέρη Χρήστο</li>
						<li>Κατσιγιάννη Θεόφιλο</li>
						<li>Παπαδόπουλο Κωνσταντίνο</li>
					</ul>

				</div><!--end of col-sm-4-->
				<div class="col-sm-2">
					<h6>Navigation</h6>
					<ul class="unstyled">
						<li><a href="index.php">Home</a></li>
						<li><a href="index.php">Services</a></li>
					</ul>
				</div><!--end of col-sm-2-->
				<div class="col-sm-2">
					<h6>Follow Us</h6>
					<ul class="unstyled">
						<li><a href="#">Twitter</a></li>
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Google Plus</a></li>
					</ul>
				</div><!--end of col-sm-2-->
			</div><!--end of row-->
		</div><!--end of container-->	
	</footer>

	<!-- All Javascript at the bottom of the page for faster page loading -->
		
	<!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Custom JS -->
	<script src="includes/js/script.js"></script>

</body>
