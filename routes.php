<?php
    error_reporting(0);
    session_start();

    if( !$_SESSION['userid']|| !isset($_SESSION['userid']))
    {
        header("Location:index.php");
    }

    

    require_once "../inc/config.php";

    require_once "../inc/dbhelper.php";

    require_once "../bookHelper.php";

    

    $db=new Database();

    $db->open();

    

    $msg="";

    $block="";

    $class="";

    $task=$_REQUEST['task'];
    $from=$_REQUEST['tfrom'];
    $to=$_REQUEST['tto'];
    $depart_date=$_REQUEST['depart_date'];
    $depart_time=$_REQUEST['depart_time'];

    $fare=$_REQUEST['fare'];
    $id=$_REQUEST['id'];

    $creator=$_SESSION['userid'];

    $created_date = date("Y-m-d H:i:s"); 

    

    $published=$_REQUEST['published'];

    

    $action=$_REQUEST['action'];

    $busid=$_REQUEST['busid'];

    $sql="";

    $userid=$_SESSION['userid'];

    if($task=="create")

    {

        if($id)

        {

            $sql="UPDATE `jos_route` SET `tfrom`='".$from."',`tto`= '".$to."',`busid`='".$busid."',`published`='".$published."',depart_time='".$depart_time."',depart_date='".$depart_date."',fare='".$fare."' WHERE id=".$id;

           // echo $sql;die;

            $msg="updated.";

        }

        else

        {

            $sql="INSERT INTO `jos_route` (`id`, `tfrom`,`tto`,`busid`,`depart_time`, `depart_date`,fare, `published`) 

            VALUES ('".$userid."', '".$from."','".$to."', '".$busid."','".$depart_time."', '".$depart_date."','".$fare."', '".$published."',)";

            $msg="inserted.";
            

        }
            // echo $sql;die;
        $result=$db->query($sql);

        

        

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

    

    if($action=='update')

    {

        $sql="UPDATE `jos_route` SET published=$published WHERE id=".$id;

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

        $sql="DELETE FROM `jos_route` WHERE id=".$id;

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

    

     $sql="SELECT a.*, b.`location` as from_location, c.`location` as to_location, d.`bus_no`  
           FROM `jos_route` as a 
           JOIN `jos_location` as b ON a.`tfrom` = b.id  
           JOIN `jos_location` as c ON a.`tto` = c.id 
           JOIN `jos_bus` as d ON a.`busid` = d.id
           ORDER BY a.id DESC";

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

                    <a href="addroute.php" class="active btn float-right">Add Route</a>
                    <br /><br />
                    <form method="get">

				    	<table>
						<thead>

							<tr>

								<th>From</th>

                                <th>To</th>
                                <th>Bus No.</th>
                                <th>Date & Time</th>
								<th>Published</th>

								<th colspan="2" width="10%">Actions</th>

							</tr>

                        

						</thead>

						<tbody>

							 <?php   

                                 while($row=$db->fetcharray($result))

                                 {

                                   ?>

                                   <tr>

                                   <td><?php echo $row['from_location'];?></td>

                                   <td><?php echo $row['to_location'];?></td>
                                   <td><?php echo $row['bus_no'];?></td>
                                   <td><?php echo date('d/m/Y',strtotime($row['depart_date'])).'-'.$row['depart_time'];?> </td>
                                   <?php

                                   $p=$row['published'];

                                   if($p)

                                   {

                                    ?>

                                         <td><a href="routes.php?id=<?php echo $row['id']?>&action=update&published=0"><img src="images/tick-circle.gif" /></a></td>

                                         <?php

                                   }

                                   else

                                   {

                                    ?>

                                        <td><a href="routes.php?id=<?php echo $row['id']?>&action=update&published=1"><img src="images/minus-circle.gif" /></a></td>

                                        <?php

                                   }

                                   ?>

                                  

                                   <td><a href="addroute.php?id=<?php echo $row['id'];?>" class="edit">Edit</a></td>

								   <td><a href="routes.php?id=<?php echo $row['id'];?>&action=remove" class="delete">Delete</a></td>

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