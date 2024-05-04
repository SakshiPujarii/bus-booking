<?php
    error_reporting(0);
    session_start();
    if( !$_SESSION['userid']|| !isset($_SESSION['userid']))
    {
        header("Location:index.php");
    }
    
    require_once "../inc/config.php";
    require_once "../inc/dbhelper.php";
    
    $db=new Database();
    $db->open();
    
    $msg="";
    $block="";
    $class="";
    
    $task=$_REQUEST['task'];
    $type=$_REQUEST['type'];
    $bus_name=$_REQUEST['bus_name'];
    $bus_no=$_REQUEST['bus_no'];
    $id=$_REQUEST['id'];
    $creator=$_SESSION['userid'];
    $created_date = date("Y-m-d H:i:s"); 
    
    $published=$_REQUEST['published'];
    
    $action=$_REQUEST['action'];
    $sql="";
    
    if($task=="create")
    {
        if($id)
        {
            $sql="UPDATE `jos_bus` SET type= '".$type."',bus_name='".$bus_name."',bus_no='".$bus_no."',published='".$published."',creator='".$creator."',created_date='".$created_date."' WHERE id=".$id;
            $msg="updated.";
        }
        else
        {
            $sql="INSERT INTO `jos_bus` (`id`, `type`,`bus_name`,`bus_no`, `creator`, `created_date`, `published`) 
            VALUES (NULL, '".$type."','".$bus_name."','".$bus_no."', '".$creator."', '".$created_date."', '".$published."')";
            $msg="inserted.";
        }
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
        $sql="UPDATE `jos_bus` SET published=$published WHERE id=".$id;
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
        $sql="DELETE FROM `jos_bus` WHERE id=".$id;
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
    
     $sql="SELECT * FROM `jos_bus` ORDER BY id DESC";
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
                    <a href="addbus.php" class="active btn float-right">Add Bus</a>
                    <br /><br />
                    <form method="get">
				    	<table>
                        
                        
						<thead>
							<tr>
								<th>Bus Type </th>
                                <th>Bus Name</th>
                                <th>Bus No</th>
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
                                   <td><?php echo $row['type'];?></td>
                                   <td><?php echo $row['bus_name'];?></td>
                                   <td><?php echo $row['bus_no'];?></td>
                                   <?php
                                   $p=$row['published'];
                                   if($p)
                                   {
                                    ?>
                                         <td><a href="busses.php?id=<?php echo $row['id']?>&action=update&published=0"><img src="images/tick-circle.gif" /></a></td>
                                         <?php
                                   }
                                   else
                                   {
                                    ?>
                                        <td><a href="busses.php?id=<?php echo $row['id']?>&action=update&published=1"><img src="images/minus-circle.gif" /></a></td>
                                        <?php
                                   }
                                   ?>
                                  
                                   <td><a href="addbus.php?id=<?php echo $row['id'];?>" class="edit">Edit</a></td>
								   <td><a href="busses.php?id=<?php echo $row['id'];?>&action=remove" class="delete">Delete</a></td>
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