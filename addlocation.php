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
    $id=$_REQUEST['id'];
    
    if($id)
    {
        $sql="SELECT * FROM `jos_location` WHERE `id`=".$id;
        $result=$db->query($sql);
        $location_info=$db->fetchobject($result);
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
            
            function validform()
            {
                var location=document.getElementById("location").value;                
                                                
                if(location==null || location=="" )
                {
                    alert("Enter location");
                    return false;
                }
                
                return true;
            }
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
    
        <div align="center">
                
            <form method="post" action="locations.php" enctype="multipart/form-data" onsubmit="return validform();">
            <table>
               
                <tr>
                    <td>Location Name :</td>
                    <td><input type="text" id="location" name="location" value="<?php echo $location_info->location;?>" /></td>
                </tr>
                <tr>
                    <td>Published :</td>
                    <td>
                        <select name="published" id="published" >
                            <?php if($location_info->published)
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
                        <input type="hidden" id="id" name="id" value="<?php echo $location_info->id;?>" />
                        <input type="hidden" name="task" value="create" />
                        <input type="submit" value="Submit"/>
                        <input type="reset" value="Clear" />
                        <a href="locations.php">Cancel</a>
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