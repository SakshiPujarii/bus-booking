<?php
error_reporting(0);
require_once "bookHelper.php";

$db = new Database();
$db->open();
$route_id=$_REQUEST['route_id'];
$reserve_seats=$_REQUEST['reserve_seats'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$email=$_REQUEST['email'];
$address=$_REQUEST['address'];
$city=$_REQUEST['city'];
$zip=$_REQUEST['zip'];
$country=$_REQUEST['country'];
$mobile=$_REQUEST['mobile'];
$total_fare=$_REQUEST['total_fare'];
$created_date = date("Y-m-d H:i:s");
$booking_id = rand(10000,1000000);


$sql = "SELECT a.*, b.`location` as from_location, c.`location` as to_location, d.`bus_no`, d.`type`, d.`bus_name`      
           FROM `jos_route` as a 
           JOIN `jos_location` as b ON a.`tfrom` = b.id  
           JOIN `jos_location` as c ON a.`tto` = c.id 
           JOIN `jos_bus` as d ON a.`busid` = d.id
		   WHERE a.`id` = " . $route_id;
    
    // echo $sql;die;
    $result=$db->query($sql);
   $row = $db->fetchobject($result);

// $sql = "SELECT a.*, b.`first_name`, b.`last_name`, b.`email`, b.`city`, b.`mobile`, b.`address`, b.`zip`, b.`country`, b.`total_fare`, c.`depart_date`, c.`depart_time`,  d.`location` as from_location, e.`location` as to_location, f.`bus_no`
//             FROM `jos_reservation` as a 
//             JOIN `jos_passangers` as b ON a.`passanger_id` = b.`id` 
//             JOIN `jos_route` as c ON a.`route_id` = c.id 
//             JOIN `jos_location` as d ON c.`tfrom` = d.id  
//             JOIN `jos_location` as e ON c.`tto` = e.id 
//             JOIN `jos_bus` as f ON c.`busid` = f.id
//             WHERE a.`id` = " . $id;
// $result = $db->query($sql);
// $row = $db->fetchobject($result);
?>
<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 	 ]>    <html class="ie" lang="en"> <![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="HandheldFriendly" content="True">
	<title>Bus Booking - Booking</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen,projection,print" />
	<link rel="stylesheet" href="css/theme-turqoise.css" id="template-color" />
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/selectnav.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript">
		function printpage() {
			window.print();
		}
	</script>
	<script type="text/javascript">
		window.console = window.console || (function () {
			var c = {}; c.log = c.warn = c.debug = c.info = c.error = c.time = c.dir = c.profile = c.clear = c.exception = c.trace = c.assert = function () { };
			return c;
		})();
	</script>
	<link rel="stylesheet" href="css/styler.css" type="text/css" media="screen,projection,print" />
	<style>
		.print {
			float: right;
			margin: -5px 25px 0 0;
		}

		@media print {

			.no-print,
			.no-print * {
				display: none !important;
			}
		}
	</style>
</head>

<body>

	<!--header-->
	<?php
	require_once "header.php";
	?>
	<!--main-->
	<div class="main" role="main">
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">

				<!--three-fourth content-->
				<section class="three-fourth">
					<form id="booking" method="post" action="booking" class="booking">
						<fieldset>
							<h3><span>03 </span>Confirmation</h3>
							<?php if ($row->status == 0) { ?>
								<div class="text-wrap">
									<a href="#" class="gradient-button print no-print" title="Print booking"
										onclick="printpage()">Print booking</a>
									<p><b>Thanks for booking. Your booking confirmation is now pending. Please make payment
											on this GPay/Phonepe 7259443769 mobile no or below QR Code and send screenshot
											with booking number on whatsapp 72593443769 and confirm your seats.</b></p>
								</div>
							<?php } else if ($row->status == 1) { ?>
									<div class="text-wrap">
										<a href="#" class="gradient-button print no-print" title="Print booking"
											onclick="printpage()">Print booking</a>
										<p><b>Thanks for booking. Your booking is confirmed.</b></p>
									</div>
							<?php } ?>

							<h3>Traveller info</h3>
							<div class="text-wrap">
								<div class="output">
									<p>Booking number:</p>
									<p>
										<?php echo $booking_id; ?>
									</p>
									<p>First name: </p>
									<p>
										<?php echo $first_name; ?>
									</p>
									<p>Last name: </p>
									<p>
										<?php echo $last_name; ?>
									</p>
									<p>E-mail address: </p>
									<p>
										<?php echo $email; ?>
									</p>
									<p>Street Address and number:</p>
									<p>
										<?php echo $address; ?>
									</p>
									<p>Town / City: </p>
									<p>
										<?php echo $city; ?>
									</p>
									<p>ZIP code: </p>
									<p>
										<?php echo $zip; ?>
									</p>
									<p>Country:</p>
									<p>
										<?php echo $country; ?>
									</p>
									<p>Travel From:</p>
									<p>
										<?php echo $row->from_location; ?>
									</p>
									<p>Travel To:</p>
									<p>
										<?php echo $row->to_location; ?>
									</p>
									<p>Bus Number:</p>
									<p>
										<?php echo $row->bus_no; ?>
									</p>
									<p>Date and Time:</p>
									<p>
										<?php echo date('d, F Y', strtotime($row->depart_date)); ?>
										<?php echo $created_date; ?>
									</p>
									<p>Reserved Seats:</p>
									<p>
										<?php echo $reserve_seats; ?>
									</p>
									
								</div>
							</div>
							<?php if ($row->status == 0) { ?>
								<h3>Payment</h3>
								<div class="text-wrap">
									<p>Please make payment on this GPay/Phonepe 7259443769 mobile no or below QR Code and
										send screenshot on whatsapp 7259443769 and confirm your seats.</p>
									<p><img src="WhatsApp Image 2023-07-04 at 20.21.33.jpeg" alt="" height=200 width=200/></p>
								</div>
							<?php } ?>
						</fieldset>
					</form>

				</section>
				<!--//three-fourth content-->

				<!--right sidebar-->
				<aside class="right-sidebar">
					<!--Need Help Booking?-->
					<article class="default clearfix">
						<h2>Need Help Booking?</h2>
						<p>Call our customer services team on the number below to speak to one of our advisors who will
							help you with all of your holiday needs.</p>
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