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
    $id=$_REQUEST['id'];
    
    if($id)
    {
        $sql="SELECT * FROM `jos_route` WHERE `id`=".$id;
        $result=$db->query($sql);
        $route_info=$db->fetchobject($result);
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
        
        <script type="text/javascript" src="../js/jquery.min.js"></script>
	    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker-wrap input').datepicker({
        		showOn: 'button',
        		buttonImage: 'images/ico/calendar.png',
        		buttonImageOnly: true,
                dateFormat: 'yy-mm-dd'
        	});
        });
        </script>
	    <script type="text/javascript">
        function validform()
        {
            var tfrom       = document.getElementById("tfrom").value;
            var tto         = document.getElementById("tto").value;
            var busid       = document.getElementById("busid").value;
            var depart_date = document.getElementById("depart_date").value;
            var depart_time = document.getElementById("depart_time").value;
            
            if(tfrom=='')
            {
                alert("Please select from location");
                return false;
            }
            else if(tto=='')
            {
                alert("Please select to location");
                return false;
            }
            else if(busid=='')
            {
                alert("Please select bus");
                return false;
            }
            else if(depart_date=='')
            {
                alert("Please select date");
                return false;
            }
            else if(depart_time=='')
            {
                alert("Please enter time");
                return false;
            }
            else if(fare=='')
            {
                alert("Please enter fare");
                return false;
            }
        }
        </script>
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
    
    <div align="center">
                
    <form method="post" action="routes.php" enctype="multipart/form-data" onsubmit="return validform();">
    <table>
       
        <tr>
            <td>From :</td>
            <td>
                <select id="tfrom" name="tfrom">
                    <option value="">Select</option>
                    <?php 
                    $froms=BookHelper::getLocationData(0,1);
                    
                    if($froms)
                    {
                        $selected="";
                        foreach($froms as $from)
                        {
                            if($from['id']==$route_info->tfrom)
                            {
                                $selected="selected='selected'";
                            }
                            else
                            {
                                $selected="";
                            }
                            
                            echo '<option value="'.$from["id"].'" '.$selected.'>'.$from["location"].'</option>';
                        }
                    }
                    ?>
                </select>        
                
            </td>
        </tr>
        <tr>
            <td>To :</td>
            <td>
                <select id="tto" name="tto">
                    <option value="">Select</option>
                    <?php 
                    $tos=BookHelper::getLocationData(0,1);
                    
                    if($tos)
                    {
                        $selected="";
                        foreach($tos as $to)
                        {
                            if($to['id']==$route_info->tto)
                            {
                                $selected="selected='selected'";
                            }
                            else
                            {
                                $selected="";
                            }
                            
                            echo '<option value="'.$to["id"].'" '.$selected.'>'.$to["location"].'</option>';
                        }
                    }
                    ?>
                </select>    
            </td>
        </tr>
         <tr>
            <td>Bus No :</td>
            <td>
                <select id="busid" name="busid">
                    <option value="">Select</option>
                    <?php 
                    $busnos=BookHelper::getBusno(0,1);
                    
                    if($busnos)
                    {
                        $selected="";
                        foreach($busnos as $busno)
                        {
                            if($busno['id']==$route_info->busid)
                            {
                                $selected="selected='selected'";
                            }
                            else
                            {
                                $selected="";
                            }
                            
                            echo '<option value="'.$busno["id"].'" '.$selected.'>'.$busno["bus_no"].'</option>';
                        }
                    }
                    ?>
                </select>    
            </td>
        </tr>
       <tr>
            <td>Date :</td>
            <td>
                <div class="datepicker-wrap"><input type="text" id="depart_date" name="depart_date" class="datepicker6" value="<?php echo isset($route_info->depart_date)? date("y-m-d",strtotime($route_info->depart_date)): date("Y-m-d");?>" /></div>
            </td>
        </tr>
        <tr>
            <td>Time :</td>
            <td>
                <input type="text" name="depart_time" id="depart_time" value="<?php echo $route_info->depart_time;?>"/>
            </td>
        </tr>
        <tr>
            <td>Fare :</td>
            <td>
                <input type="text" name="fare" id="fare" value="<?php echo $route_info->fare;?>" />
            </td>
        </tr>
        <tr>
        <tr>
            <td>Published :</td>
            <td>
                <select name="published" id="published" >
                    <?php if($route_info->published)
                    {
                        ?>
                        <option value="1" selected="selected" >YES</option>
                        <option value="0">NO</option>
                        <?php    
                    }
                    else
                    {
                        ?>
                        <option value="0" selected="selected">NO</option> 
                        <option value="1">YES</option>
                        <?php   
                    }
                    ?>
                    
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="hidden" id="id" name="id" value="<?php echo $route_info->id;?>" />
                <input type="hidden" name="task" value="create" />
                <input type="submit" value="Submit"/>
                <input type="reset" value="Clear" />
                <a href="routes.php">Cancel</a>
            </td>
        </tr>
    </table>
    </form>
    

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