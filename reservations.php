<?php
    error_reporting(0);
    session_start();
    require_once "../inc/config.php";
    require_once "../inc/dbhelper.php";
    
    $db=new Database();
    $db->open();
    
    $msg="";
    $block="";
    $class="";
    
    $id=$_GET['id'];
    $action=$_GET['action'];
    $status=$_GET['status'];
    
    if($action=='update')
    {
        $sql="UPDATE `jos_reservation` SET status=$status WHERE id=".$id;
        $result=$db->query($sql);
        
        $msg="updated";
        $block="display:block";
        if($result) 
        {
            $msg="Record ".$msg;
            $class="n-success";
        }
        else
        {
            $msg="Record not ".$msg;
            $class="n-error";
        }
    }
    
    if($action=='remove')
    {
        $sql="DELETE FROM `jos_reservation` WHERE id=".$id;
        $result=$db->query($sql);
        
        $msg="removed";
        $block="display:block";
        if($result) 
        {
            $msg="Record ".$msg;
            $class="n-success";
        }
        else
        {
            $msg="Record not ".$msg;
            $class="n-error";
        }
    }
 
 
     $sql = "SELECT a.*, b.`first_name`, b.`last_name`, b.`email`, b.`city`, b.`mobile`, b.`address`, b.`zip`, b.`country`, b.`total_fare`, c.`depart_date`, c.`depart_time`,  d.`location` as from_location, e.`location` as to_location, f.`bus_no`
            FROM `jos_reservation` as a 
            JOIN `jos_passangers` as b ON a.`passanger_id` = b.`id` 
            JOIN `jos_route` as c ON a.`route_id` = c.id 
            JOIN `jos_location` as d ON c.`tfrom` = d.id  
            JOIN `jos_location` as e ON c.`tto` = e.id 
            JOIN `jos_bus` as f ON c.`busid` = f.id
            ORDER BY a.id DESC ";
     $result=$db->query($sql);
?>
    
   



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Bus Booking Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<!--<link rel="stylesheet" href="css/fluid.css" type="text/css" media="screen" charset="utf-8" />-->
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
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
            
				<div class="grid_16">
                
                <span class="notification <?php echo $class;?>" style="<?php echo $block;?>"><?php echo $msg;?></span>
                    <form method="get">
				    	<table>
						<thead>
							<tr>
								<th>No.</th>
								<th>Travel</th>
                                <th>Bus Number</th>
                                <th>Date & Time</th>
								<th>Traveller Name</th>
                                <th>Phone</th>
                                <th>Status</th>
								<th colspan="2" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							 <?php   
                                 while($row=$db->fetcharray($result))
                                 {
                                   ?>
                                   <tr>
                                   <td><?php echo $row['id'];?></td>
                                   <td><?php echo $row['from_location'].'-'.$row['to_location'];?> </td>
                                   <td><?php echo $row['bus_no'];?></td>
                                   <td><?php echo date('d/m/Y',strtotime($row['depart_date'])).'-'.$row['depart_time'];?> </td>
                                   <td><?php echo $row['first_name'].' '.$row['last_name'];?></td>
                                   <td><?php echo $row['mobile'];?></td>
                                   <?php
                                   $p=$row['status'];
                                   if($p)
                                   {
                                    ?>
                                         <td><a href="reservations.php?id=<?php echo $row['id']?>&action=update&status=0"><img src="images/tick-circle.gif" /></a></td>
                                         <?php
                                   }
                                   else
                                   {
                                    ?>
                                        <td><a href="reservations.php?id=<?php echo $row['id']?>&action=update&status=1"><img src="images/minus-circle.gif" /></a></td>
                                        <?php
                                   }
                                   ?>
								   <td><a href="reservations.php?id=<?php echo $row['id'];?>&action=remove" class="delete">Delete</a></td>
                                   </tr> 
                                   <?php
                                 }  
                                 ?> 
						
						</tbody>
				    	</table>
                    </form>
				</div>
			</div>
		
		<div id="foot">
			Copyright <?php echo date('Y');?> Bus Booking Admin. All rights reserved.
		</div>
	</body>
</html>