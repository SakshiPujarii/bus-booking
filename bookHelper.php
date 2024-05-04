<?php
//session_start();
require_once "inc/config.php";
require_once "inc/dbhelper.php";

class BookHelper
{
    
    function getLocationbyid($id)
    {
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `jos_location` WHERE id=".$id;
        $result=$db->query($sql);
        $location=$db->fetchobject($result);
        
        return $location->location;
    }
    
    function getSeats($id)
    {
        $db=new Database();
        $db->open();
        $sql="SELECT `reserve_seats` FROM `jos_reservation` as a JOIN `jos_route` as b ON a.`route_id`=b.`id` WHERE b.`id`=".$id." AND a.`status` = 1";
        $result=$db->query($sql);
        $seats=array();
        
        while($row=$db->fetcharray($result))
        {
            $seats[]=$row['reserve_seats'];
        }
        
        return $seats;
    }
    
    function getLocationData($id=0,$published=0)
    {
        $extraSQL=$locations=array();
        
        if($id)
        {
            $extraSQL[]="id=".$id;
        }
        
        if($published)
        {
            $extraSQL[]="published=".$published;
        }
        
        
        $extraSQL=implode(' AND ',$extraSQL);
        
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `jos_location` WHERE ".$extraSQL;
        //echo $sql;die;
        
        $result=$db->query($sql);
        
        while($row=$db->fetcharray($result))
        {
            $locations[]=$row;
        }
        
        return $locations;
    }
    
     function getBusno($id=0,$published=0)
    {
        $extraSQL=$busses=array();
     
        if($id)
        {
            $extraSQL[]="id=".$id;
        }
        
        if($published)
        {
            $extraSQL[]="published=".$published;
        }
        
        
        $extraSQL=implode(' AND ',$extraSQL);
        //echo "hiiiiii";
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `jos_bus` WHERE ".$extraSQL;
       // echo $sql;die;
        
        $result=$db->query($sql);
        
        while($row=$db->fetcharray($result))
        {
            $busses[]=$row;
        }
        
        return $busses;
    }
    
}
?>