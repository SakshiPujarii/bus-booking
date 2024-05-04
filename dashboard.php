<?php
    error_reporting(0);
    session_start();
    if( !$_SESSION['userid']|| !isset($_SESSION['userid']))
    {
        header("Location:index.php");
    }
    
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Bus Booking Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
		<!--[if IE]><![if gte IE 6]><![endif]-->
		<script src="js/glow/1.7.0/core/core.js" type="text/javascript"></script>
		<script src="js/glow/1.7.0/widgets/widgets.js" type="text/javascript"></script>
		<link href="js/glow/1.7.0/widgets/widgets.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript">
			glow.ready(function(){
				new glow.widgets.Sortable(
					'#content .grid_5, #content .grid_6',
					{
						draggableOptions : {
							handle : 'h2'
						}
					}
				);
			});
		</script>
		<!--[if IE]><![endif]><![endif]-->
	</head>
	<body>

	<div id="head">
        <span style="float:right">Welcome <?php echo $_SESSION['username'];?><a href="logout.php">Logout</a></span>
        <h1>Bus Booking Admin</h1>

    </div>
		<?php
            require_once "adminmenu.php";
        ?>
        
		<div id="content" class="container_16 clearfix">
			<div class="grid_13">
                <a class="dashboard-module" href="reservations.php">
                    <img width="64" height="64" alt="edit" src="images/Crystal_Clear_write.gif" />
                    <span>Reservations</span>
                </a>
                
                <a class="dashboard-module" href="addroute.php">
                    <img width="64" height="64" alt="edit" src="images/Crystal_Clear_write.gif" />
                    <span>Add Route</span>
                </a>
                
                <a class="dashboard-module" href="addbus.php">
                    <img width="64" height="64" alt="edit" src="images/Crystal_Clear_write.gif" />
                    <span>Add Bus</span>
                </a>  
                
                
                <a class="dashboard-module" href="addlocation.php">
                    <img width="64" height="64" alt="edit" src="images/Crystal_Clear_write.gif" />
                    <span>Add Location</span>
                </a>
                
                <a class="dashboard-module" href="user.php">
                    <img width="64" height="64" alt="edit" src="images/Crystal_Clear_user.gif" />
                    <span>Create Users</span>
                </a>
                
            </div>
 
            
            				
            </div>
		<div id="foot">
			<div class="container_16 clearfix">
				<div class="grid_16">
					Copyright <?php echo date('Y');?> Bus Booking Admin. All rights reserved.
				</div>
			</div>
		</div>
	</body>
</html>