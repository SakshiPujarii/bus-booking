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
    
    $id=$_GET['id'];    
    $row=array();
    if($id)
    {
        $sql="SELECT * FROM `jos_admins` WHERE id=".$id;
        $result=$db->query($sql);
        $row=$db->fetchobject($result);    
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
                //var u=document.forms["adminlogin"]["username"].value;
                var username=document.getElementById("username").value;                
                //var p=document.forms["adminlogin"]["password"].value;
                var password=document.getElementById("password").value;
                                                
                if(username==null || username=="" )
                {
                    alert("Enter username");
                    return false;
                }
                else if(password==null || password=="")
                {
                    alert("Enter Password");
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
                            
                <form method="post" action="users.php" enctype="multipart/form-data">
                <table>
                   
                    <tr>
                        <td>User Name :</td>
                        <td><input type="text" id="username" name="username" value="<?php echo $row->username;?>" /></td>
                    </tr>
                    <tr>
                    
                        <td>Password :</td>
                        <td>
                            <input type="password" id="password" name="password" value="<?php echo $row->password;?>"/><br />
                        </td>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" id="first_name" name="first_name" value="<?php echo $row->first_name;?>" /></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><input type="text" id="last_name" name="last_name" value="<?php echo $row->last_name;?>" /></td>
                    </tr>
                    <tr>
                        <td>Enter Email:</td>
                        <td><input type="text" id="email" name="email" value="<?php echo $row->email;?>" /></td>
                    </tr>
                    <tr>
                        <td>Published :</td>
                        <td>
                            <select name="published" id="published" >
                                <?php 
                                if($row->published)
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
                            <input type="hidden" id="id" name="id" value="<?php echo $row->id;?>" />
                            <input type="hidden" name="task" value="create" />
                            <input type="submit" value="Submit"/>
                            <input type="reset" value="Reset" />
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