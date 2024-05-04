<?php
    error_reporting(0);
    session_start();
    if($_SESSION['userid']||isset($_SESSION['userid']))
    {
        header("Location:dashboard.php");
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
                                                
                if(username=="" )
                {
                    alert("Enter username");
                    return false;
                }
                else if(password=="")
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
        
        <h1>Bus Booking Admin</h1>

    </div>

			<div id="content" class="container_16 clearfix">
                <div align="center" style="min-height: 350px;">
                <form name="adminlogin" id="adminlogin" action="checklogin.php" method="post" onsubmit="return validform()">
                    <table style="width:38%;margin-top: 100px;" >
                        <?php
                        $msg=$_GET['msg'];
                      
                        if($msg)
                        {
                            ?>
                            <tr>
                                <td colspan="2" style="text-align: center;color: #FF0000;">Invaild Username Or Password</td>
                            </tr>
                            <?php
                        }
                          ?>
                        <tr>
                            <td width="70" style="background: none;">UserName:</td>
                            <td style="background: none;"><input type="text" name="username" id="username" /></td>
                        </tr>
                        <tr>
                            <td width="70" style="background: none;">Password:</td>
                            <td style="background: none;"><input type="password" name="password" id="password" /></td>
                        </tr>
                         <tr>
                            <td style="background: none;">&nbsp;</td>
                            <td style="background: none;">
                                <input type="submit" value="Login" />
                                <input type="reset" name="reset" id="reset" value="Clear" />
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