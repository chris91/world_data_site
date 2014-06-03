<?php

session_start();
include_once 'Security.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
	//if login not null then the login is successfull
	if(Security::instance()->login($_POST['email'],$_POST['password'])){
		//header('Location: private.php');
	}
	else{//else there is a problem to email or to password
		//$message='email or password incorrect email'; here
	}
}
	if(isset($_SESSION['user_email'])){
		$user_email=$_SESSION['user_email'];
	}else{
		$user_email='guest';
	} 
?>


<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta http-equiv='Content-Language' content='el' />
		<!-- Website Title & Description for Search Engine purposes -->
		<title></title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="includes/css/styles.css" rel="stylesheet">
		
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="includes/js/modernizr-2.6.2.min.js"></script>
		
	</head>
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
	<div class="carousel slide" id="myCarousel"><!--this the carousel class this is a bootstrap class-->
		<!--Indicators-->
		<ol class="carousel-indicators">
			<li class="active" data-slide-to="0" data-targer="#myCarousel"></li>
			<li data-slide-to="1" data-targer="#myCarousel"></li>
			<li data-slide-to="2" data-targer="#myCarousel"></li>
		</ol>
		<!--Wrapper for slides-->
		<div class="carousel-inner">
			<div class="item active" id="slide1">
				<div class="carousel-caption">
					<h4></h4>
					<p></p>
				</div><!--end of carousel-caption-->

			</div><!--end of item-->
			<div class="item" id="slide2">
				<div class="carousel-caption">
					<h4></h4>
					<p></p>
				</div><!--end of carousel-caption-->
			</div><!--end of item-->
			<div class="item" id="slide3">
				<div class="carousel-caption">
					<h4></h4>
					<p></p>
				</div><!--end of carousel-caption-->
			</div><!--end of item-->
		</div><!--end of carousel-inner-->	

		<!--controls-->	
		<a class="left carousel-control" data-slide="prev" href="#myCarousel"><span class="icon-prev"></span></a>
		<a class="right carousel-control" data-slide="next" href="#myCarousel"><span class="icon-next"></span></a>


	</div><!--end of carousel-->
	<!--bootstrap uses the grid system-->
	<div class="row" id="bigCallout"><!--contains the element of the main article -->
		<div class="col-12">
			<!--<div class="alert alert-success alert-block fade in" id="successAlert">-->
			<div class="alert alert-danger alert-block fade in" id="successAlert">
				<button type="button" class="close" data-dismiss="alert">
					&times;	
				</button><!--end of the alert button-->
				<h4>Αποτυχία Εισόδου</h4>
				<p>Κάντε login στο σύστημα</p>
			</div><!--end alert-->

			<!--Visible only on small devices-->
			<div class="well well-small visible-sm">
				<a href="" class="btn btn-large btn-block btn-default">
					<span class="glyphicon glyphicon-phone"></span>
					Give us a call
				</a><!--btn-block uses the whole width of the parent element-->
			</div><!--end of small-well-->
			<div class="well">
				<div class="page-header">
					<h1>Σύστημα οπτικοποίησης Βάσης Δεδομένων </h1>
				</div><!--end page-header-->	
				<p class="lead">
					Η συγκεκριμένη εφαρμογή αναπτύχθηκε στα πλαίσια του εργαστηρίου για το μάθημα “Προχωρημένα Θέματα Τεχνολογίας και Εφαρμογών Βάσεων Δεδομένων” του τμήματος <a href="http://www.cs.uoi.gr/" target="_blank">Μηχανικών Υπολογιστών και Πληροφορικής</a> του <a href="http://www.uoi.gr/" target="_blank"> Πανεπιστημίου Ιωαννίνων</a>. Σκοπό έχει την οπτικοποίηση δεδομένων που προέρχονται από την Βάση <a href="http://www.worldbank.org/" target="_blank">WorldBank</a>. 
				</p>
				<!--<a href="#myModal" class="btn btn-large btn-primary" data-toggle="modal" id="alertMe">Είσοδος στο Σύστημα</a>-->
<a href="#myModal" role="button" class="btn btn-warning" data-toggle="modal" id="alertMe"><span class="glyphicon glyphicon-hand-up"></span> Είσοδος στο Σύστημα<a>
				<!--<a href="#" class="btn btn-large btn-link">Or a  secondary link</a>-->
				<div class="modal fade" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Login Form</h4>
							</div><!--end modal-header-->
							<div class="modal-body">
								<h4>Login</h4>
					<p>Παρακαλούμε συμπληρώστε τα παρακάτω πεδία.</p>

								<hr>
								<form class="form-horizontal" method="post">
									<?php 
										if(isset($message)){
											echo '<div class="error">'.$message.'</div>';
										}
									?>

									<div class="form-group">
										<label class="col-lg-2 control-label" for="inputEmail">Email</label>
										<div class="col-lg-10">
											<input class="form-control" id="inputEmail" placeholder="Email" type="email" name="email" value="">
										</div><!--end col-lg-10-->
									</div><!--end of form-group-->
									<div class="form-group">
										<label class="col-lg-2 control-label" for="inputPass">Password</label>
										<div class="col-lg-10">
											<input class="form-control" id="inputPass" placeholder="Password" type="password" name="password" value=""/>
										</div><!--end col-lg-10-->
									</div><!--end of form-group-->
							</div><!--end of modal-body-->
							<div class="modal-footer">
								<button class="btn btn-default" data-dismiss="modal" type="button">Κλείσιμο</button>
								<button class="btn btn-primary" type="submit" value="Log in">Υποβολή</button>
							</div><!--end of modal footer-->
								</form><!--end of the form-->
						</div><!--end modal content-->
					</div><!--end modal dialog-->
				
				</div><!--end myModal-->
			</div><!--end well-->
		</div><!--end of col-12-->
	</div><!--end of row bigCallout--></a>
	<div class="row" id="featuresHeading"><!--contains 12 of elements to be added to the report in bootstrap-->
		<div class="col-12">
		<h2>Επιλογές ενεργειών</h2>
		<p class="lead">Το σύστημα παρέχει τις εξης δυνατότητες ενεργειών. Παρέχεται δυνατότητα επεξεργασίας και ανανέωσης της Βάσης καθώς και την άντληση των δεδομένων ,επεξεργασία αυτών και απεικόνιση των αποτελεσμάτων σε οπτικοποιημένη μορφή. </p>
		</div><!--end of col-12-->	
	</div><!--end of row featuresHeading-->

	<div class="row" id="features">
		<div class="col-sm-6 feature"><!--first col-->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Λάβετε Στατιστικά Για Αυτές Τις Χώρες</h3>	
				</div><!--end panel-heading-->
				<img src="images/1.jpg" alt="HTML5" class="img-circle">

				<p>Μπορείτε να επεξεργαστείτε δεδομένα σε  οπτικοποιημένη μορφή. Οι μορφές αυτές είναι Timelines/trendlines ,Barcharts και Scatterplots.</p>
			<a href="take.php" target="_self" class="btn btn-warning btn-block">Λάβετε Στατιστικά</a>
			</div><!--end panel-->
		</div><!--end of col-sm-4-->
		<div class="col-sm-6 feature"><!--second col-->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Ανανεώστε τη Βάση με Νέα Στατιστικά</h3>	
				</div><!--end panel-heading-->
				<img src="images/2.jpg" alt="CSS3" class="img-circle">

				<p>Μπορείτε να μεταβάλετε τη Βάση προσθέτοντας ,αφαιρόντας η ανανεώνοντας τη Βάση με νέα δεδομένα.</p>
			<a href="importdata.php" target="_self" class="btn btn-danger btn-block">Ανανεώστε τη Βάση</a>
			</div><!--end panel-->
		</div><!--end of col-sm-4-->
	</div><!--end of row features-->


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
</html>

