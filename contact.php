<?php
    error_reporting(0);
    require_once "bookHelper.php";
    
    $helper    = new BookHelper();
?>
<!doctype html>
<!--[if IE 7 ]>    <html class="ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 	 ]>    <html class="ie" lang="en"> <![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>
<head>
	<meta charset="utf-8">
	<title>Bus Booking</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen,projection,print" />
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
    
     <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
     
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/sequence.jquery-min.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/sequence.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>
<body>
	<!--header-->
	<?php
    
    require_once "header.php";
    ?>
	<!--//header-->
	
	<!--main-->
	<div class="main" role="main">		
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">
				<!--three-fourth content-->
				<section class="three-fourth">
					<h1>Contact us</h1>
					<!--map-->
					<div class="map-wrap">
						<!--contact info-->
    					<article class="default">
    						<h2>Contact us</h2>
                            <p>Chiplun,Maharashtra</p>
    						<p class="phone-green">7259443769</p>
    						<p class="email-green"><a href="mailto:info@bookyourtravel.com">info@bookyourtravel.com</a></p>
    					</article>
    					<!--//contact info-->
					</div>
					<!--//map-->
				</section>	
				<!--three-fourth content-->
			</div>
			<!--//main content-->
		</div>
	</div>
	<!--//main-->
	
	<!--footer-->
	<?php
    require_once "footer.php";
    ?>
	<!--//footer-->

</body>
</html>