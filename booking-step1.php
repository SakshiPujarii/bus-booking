<?php
    error_reporting(0);
    require_once "bookHelper.php";
    
    $db=new Database();
    $db->open();
    
    $route_id=$_REQUEST['route_id'];
    $reserve_seats=$_REQUEST['reserve_seats'];
    
     $reserve_seats1=explode(",",$reserve_seats);
     $countseats=count($reserve_seats1);
     
     $sql="select * from jos_route where id=".$route_id;
     
     $result=$db->query($sql);
     $fare=$db->fetchobject($result);
     $total_fare=$fare->fare*$countseats;
     
    

?>
<!doctype html>
<!--[if IE 7 ]>    <html class="ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 	 ]>    <html class="ie" lang="en"> <![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>
<head>
	<meta charset="utf-8">
	<title>Bus Booking - Booking</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen,projection,print" />
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
    
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
      
    <!---------------------------- Validation ------------------------------------------>
    
    <script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#booking").validationEngine();
		});
	</script>
    <!---------------------------- Validation ------------------------------------------>
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
						<form id="booking" method="post" action="booking-step2.php" class="booking">
							<fieldset>
								<h3><span>01 </span>Traveller info</h3>
								<div class="row twins">
									<div class="f-item">
										<label for="first_name">First name</label>
										<input type="text" id="first_name" name="first_name" class="validate[required]" />
									</div>
									<div class="f-item">
										<label for="last_name">Last name</label>
										<input type="text" id="last_name" name="last_name" class="validate[required]" />
									</div>
								</div>
								
								<div class="row twins">
									<div class="f-item">
										<label for="email">Email address</label>
										<input type="email" id="email" name="email" class="validate[required]" />
									</div>
									<div class="f-item">
										<label for="mobile">Mobile</label>
										<input type="text" id="mobile" name="mobile" class="validate[required]" />
									</div>
								</div>
								
								<div class="row twins">
									<div class="f-item">
										<label for="address">Street Address</label>
										<input type="text" id="address" name="address" class="validate[required]" />
									</div>
									<div class="f-item">
										<label for="city">Town / City</label>
										<input type="text" id="city" name="city" class="validate[required]"/>
									</div>
								</div>
								
								<div class="row twins">
									<div class="f-item">
										<label for="zip">ZIP Code</label>
										<input type="text" id="zip" name="zip" class="validate[required]"/>
									</div>
									<div class="f-item">
										<label for="country">Country</label>
										<input type="text" id="country" name="country" class="validate[required]"/>
									</div>
								
                                <input type="hidden" name="route_id" value="<?php echo $route_id;?>" />
                                <input type="hidden" name="reserve_seats" value="<?php echo $reserve_seats;?>" />
								<input type="submit" class="gradient-button" value="Proceed to next step" id="next-step" />
							</fieldset>
						</form>
					</section>
				<!--//three-fourth content-->
				
				<!--right sidebar-->
				<aside class="right-sidebar">
					
					<!--Need Help Booking?-->
					<article class="default clearfix">
						<h2>Need Help Booking?</h2>
						<p>Call our customer services team on the number below to speak to one of our advisors who will help you with all.</p>
						<p class="number">7259443769</p>
					</article>
					<!--//Need Help Booking?-->
				</aside>
				<!--//right sidebar-->
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