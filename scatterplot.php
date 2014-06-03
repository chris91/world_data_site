<?php
session_start();
include_once 'Security.php';
Security::instance()->require_login();
?>


<?php
include_once 'Auth.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
	$indicator=$_POST['formDoor'];
	$countries=$_POST['indicator'];
	$years=$_POST['myyears'];
	Auth::instance()->_create_data_barchart4($countries,$indicator,$years);

	//create report
	$date = date_create();
	$file = 'scatterplot.tsv';
	$newfile = "reports/test".date_timestamp_get($date).".txt";//date('m/d/Y', 1299446702);
	Auth::instance()->_insert_new_report($_SESSION['user_id'],date_timestamp_get($date),$newfile,'scatterplot');
	if (!copy($file, $newfile)) {
	    echo "failed to copy $file...\n";
	}


	header('Location: scatterplot1.php');
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
	<!--bootstrap uses the grid system-->
	<div class="row" id="bigCallout1"><!--contains the element of the main article -->
		<div class="col-12">
			<!--<div class="alert alert-success alert-block fade in" id="successAlert">-->
			<div class="alert alert-danger alert-block fade in" id="successAlert">
				<button type="button" class="close" data-dismiss="alert">
					&times;	
				</button><!--end of the alert button-->
				<h4>Success!</h4>
				<p>This element done by using JQuery. Press the button "x"</p>
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
					<h1>Σύστημα οπτικοποίησης Βάσης Δεδομένων</h1>
				</div><!--end page-header-->	
				<p class="lead">
					Επιλέξτε από την παρακάτω λίστα 
				</p>
				
			</div><!--end well-->
		</div><!--end of col-12-->
	</div><!--end of row bigCallout-->

	<div class="row" id="features">
		<form class="form-inline" role="form" method="post"><!--edo-->
			<div class="col-sm-2 feature"><!--first col-->
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Έτος</h3>	
					</div><!--end panel-heading-->
  					<div class="form-group">
						<select class="selectpicker" name="myyears">
						<optgroup label="Εικοσαετίες">
							<option value="1960_1979">1960-1979</option>
							<option value="1980_1999">1980-1999</option>
							<option value="2000_2019">2000-2019</option>
						</optgroup>
						<optgroup label="Δεκαετίες">
							<option value="1960_1969">1960-1969</option>
							<option value="1970_1979">1970-1979</option>
							<option value="1980_1989">1980-1989</option>
							<option value="1990_1999">1990-1999</option>
							<option value="2000_2009">2000-2009</option>
							<option value="2010_2019">2010-2019</option>
						</optgroup>
						<optgroup label="Πενταετίες">
							<option value="1960_1964">1960-1964</option>
							<option value="1965_1969">1965-1969</option>
							<option value="1970_1974">1970-1974</option>
							<option value="1975_1979">1975-1979</option>
							<option value="1980_1984">1980-1984</option>
							<option value="1985_1989">1985-1989</option>
							<option value="1990_1994">1990-1994</option>
							<option value="1995_1999">1995-1999</option>
							<option value="2000_2004">2000-2004</option>
							<option value="2005_2009">2005-2009</option>
							<option value="2010_2014">2010-2014</option>
						</optgroup>
						</select>
  					</div><!--end form-group-->
				</div><!--end panel-->
			</div><!--end of col-sm-4-->
			<div class="col-sm-2 feature"><!--second col-->
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Χώρα</h3>	
					</div><!--end panel-heading-->
					<!--<form class="form-inline" role="form"><!--here-->
  					<div class="form-group">
						<select class="selectpicker" name="indicator">
						<optgroup label="Χώρες">
						<?php
							include_once 'Auth.php';
							$results=Auth::instance()->_find_countries();
							while ($row = $results->fetch_row()){
								echo '<option value="'.$row[0].'">'.$row[1].'</option>';
							}
						?>
						</optgroup>
						</select>
  					</div>
				</div><!--end panel-->
			</div><!--end of col-sm-4-->

			<div class="col-sm-8 feature"><!--second col-->
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Δείκτης Χώρας</h3>	
					</div><!--end panel-heading-->
					<!--<form class="form-inline" role="form">-->
					<div class="form-group">
    					<?php
						include_once 'Auth.php';
						$results=Auth::instance()->_find_indicators();
						while ($row = $results->fetch_row()){
							echo '<div class="checkbox pull-left"><label>';
							echo '<input type="checkbox" name="formDoor[]" value="'.$row[0].'"> '.$row[1].'<br />';
							echo '</label></div><br /><br />';
						}
					?>
  					</div>
  				</div><!--end panel-->
			</div><!--end of col-sm-4-->
			<div class="col-sm-12 feature" id="mybottom"><!--bottom-->
				<button type="submit" class="btn btn-warning" id="mybutton">Υποβολή</button>
			</div>
			</form><!--end of form-->
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

