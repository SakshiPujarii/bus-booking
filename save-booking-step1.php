<?php
error_reporting(0);
require_once "bookHelper.php";

$db=new Database();
$db->open();
$id=rand(10,100);
$route_id=$_REQUEST['route_id'];
$reserve_seats=$_REQUEST['reserve_seats'];
$first_name=$_REQUEST['first_name'];
$last_name=$_REQUEST['last_name'];
$email=$_REQUEST['email'];
$address=$_REQUEST['address'];
$city=$_REQUEST['city'];
$zip=$_REQUEST['zip'];
$country=$_REQUEST['country'];
$mobile=$_REQUEST['mobile'];
$total_fare=$_REQUEST['total_fare'];
$created_date = date("Y-m-d H:i:s");

$sql="INSERT INTO `jos_passangers` (`id`, `first_name`, `last_name`, `email`, `city`, `mobile`, `address`, `zip`, `country`,`total_fare`) 
     VALUES ('".$id."', '".$first_name."', '".$last_name."', '".$email."', '".$city."', '".$mobile."', '".$address."', '".$zip."', '".$country."',".$total_fare.");";

$result = $db->query($sql);

$pid= rand(10,100);

$sql="INSERT INTO `jos_reservation` (`id`, `reserve_seats`, `passanger_id`, `route_id`, `created_date`) 
      VALUES ('".$pid."', '".$reserve_seats."', '".$id."', '".$route_id."', '".$created_date."');";
$result = $db->query($sql);

$booking_id= $db->insertID();

if($booking_id)
{
    echo '<script type="text/javascript">window.location = "booking-step2.php?booking_id="+'.$booking_id.';</script>';
}
else
{
    echo '<script type="text/javascript">window.location = "booking-step2.php?booking_id=0";</script>';
}
?>