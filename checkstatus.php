<?php
    error_reporting(0);
    require_once "bookHelper.php";
    
    $helper    = new BookHelper();
    
    $db=new Database();
    $db->open();
    
    $booking_id = '';
    if($_POST)
    {
        $booking_id = $_REQUEST['booking_id'];
        $sql = "SELECT a.*, b.`first_name`, b.`last_name`, b.`email`, b.`city`, b.`mobile`, b.`address`, b.`zip`, b.`country`, b.`total_fare`, c.`depart_date`, c.`depart_time`,  d.`location` as from_location, e.`location` as to_location, f.`bus_no`
            FROM `jos_reservation` as a 
            JOIN `jos_passangers` as b ON a.`passanger_id` = b.`id` 
            JOIN `jos_route` as c ON a.`route_id` = c.id 
            JOIN `jos_location` as d ON c.`tfrom` = d.id  
            JOIN `jos_location` as e ON c.`tto` = e.id 
            JOIN `jos_bus` as f ON c.`busid` = f.id
            WHERE a.`id` = ".$booking_id;
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if($row)
        {
            echo '<script type="text/javascript">window.location = "booking-step2.php?booking_id="+'.$row->id.';</script>';
        }
        else
        {
            echo '<script type="text/javascript">window.location = "checkstatus.php?error=1";</script>';
        }
    }
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
					<h1>Check Booking Status</h1>
					<!--map-->
					<div class="map-wrap">
						<!--contact info-->
    					<article class="default">
    						<h2>Check Booking Status</h2>
                            <?php if($_REQUEST['error']) { ?> 
							<div class="text-wrap">
								<p class="text-danger"><b>Invalid booking number. Please enter valid number.</b></p>
							</div>
							<?php } ?>
    						<form action="checkstatus.php" id="contact-form" method="post">
    							<fieldset>
    								<div class="f-item">
    									<label for="booking_id">Booking Number</label>
    									<input type="text" id="booking_id" name="booking_id" value="<?php echo $booking_id;?>" />
    								</div>
                                    <br />
    								<input type="submit" value="Check" id="submit" name="submit" class="gradient-button" />
    							</fieldset>
    						</form>
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