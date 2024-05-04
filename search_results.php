<?php
    error_reporting(0);
    require_once "bookHelper.php";
    $helper = new BookHelper();
    $db=new Database();
    $db->open();
    
    $msg ="";
    $extra="";
    $id="";
    
    $id=$_REQUEST['id'];
    
    $from =$_REQUEST['from'];
    $to =$_REQUEST['to'];
    $depart_date=$_REQUEST['datepicker6'];
    //$depart_date=explode("-",$depart_date);
    //$depart_date=$depart_date[0]."-".$depart_date[1]."-".$depart_date[2];
    
    //$sql="SELECT * FROM `jos_route` WHERE published= 1 AND `tfrom`=".$from." AND `tto`=".$to." AND `depart_date`='".$depart_date."'";
    
    $sql = "SELECT a.*, b.`location` as from_location, c.`location` as to_location, d.`bus_no`, d.`type`, d.`bus_name`      
           FROM `jos_route` as a 
           JOIN `jos_location` as b ON a.`tfrom` = b.id  
           JOIN `jos_location` as c ON a.`tto` = c.id 
           JOIN `jos_bus` as d ON a.`busid` = d.id
           WHERE a.published = 1 AND a.`tfrom`=".$from." AND a.`tto`=".$to." AND a.`depart_date`='".$depart_date."'";
    
    //echo $sql;die;
    $result=$db->query($sql);
    
?>
<!doctype html>
<!--[if IE 7 ]>    <html class="ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 	 ]>    <html class="ie" lang="en"> <![endif]-->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<html>
<head>
	<meta charset="utf-8">
	<title>Bus Booking - Search results</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen,projection,print" />
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.raty.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('dt').each(function() {
			var tis = $(this), state = false, answer = tis.next('dd').hide().css('height','auto').slideUp();
			tis.click(function() {
				state = !state;
				answer.slideToggle(state);
				tis.toggleClass('active',state);
			});
		});
		
		$('.view-type li:first-child').addClass('active');
			
	});
	</script>
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
						<div class="sort-by">
							<ul class="view-type">
								<li class="grid-view"><a href="#" title="grid view">grid view</a></li>
								<li class="list-view"><a href="#" title="list view">list view</a></li>
							</ul>
						</div>
						
						<div class="deals clearfix">
                            <?php
                            
                            $num_rows=$db->num_of_rows($result);
                            if($num_rows > 0)
                            {
                                while($row=$db->fetcharray($result))
                                {
                                ?>
                                <article class="one-fourth">
							
    								<div class="details">
    									<h1><?php echo ucwords($row['from_location']);?> - <?php echo ucwords($row['to_location']);?></h1>
    									<span class="price">Fare  <em><?php echo $row['fare'];?></em> </span>
                                        <span class="date">Bus <em><?php echo $row['type'].' '.$row['bus_name'];?></em> </span>
                                        <span class="date">Depart Date <em><?php echo date("d, F Y",strtotime($row['depart_date']));?></em> </span>
                                        <span class="date">Time <em><?php echo $row['depart_time'];?></em> </span>
    									<div class="description">
    										
    									</div>
    									<a href="booknow.php?route_id=<?php echo $row['id'];?>" title="Book now" class="gradient-button">Book now</a>
    								</div>
    							</article>
                                <?php
                                }
                                
                            }
                            else
                            {
                                echo "<h1>No Bus Available</h1>";
                            }
                            ?>
							
							<!--bottom navigation-->
							<div class="bottom-nav">
								<!--back up button-->
								<a href="#" class="scroll-to-top" title="Back up">Back up</a> 
								<!--//back up button-->
							</div>
							<!--//bottom navigation-->
						</div>
					</section>
				<!--//three-fourth content-->
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