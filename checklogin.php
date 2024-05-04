<?php
    session_start();
    require_once "../inc/config.php";
    require_once "../inc/dbhelper.php";
    
    $db=new Database();
    $db->open();
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT * FROM `jos_admins` WHERE username='".$username."' AND password='".$password."' AND published=1";
    $result=$db->query($sql);
    
    if($row=$db->fetchobject($result))
    {
        //var_dump($row);die;
        $_SESSION['userid']=$row->id;
        $_SESSION['username']=$row->username;
        //header("Location:dashboard.php");
        echo '<script type="text/javascript">window.location = "dashboard.php";</script>';
    }
    else
    {
        //header("Location:index.php?msg=1");
        echo '<script type="text/javascript">window.location = "index.php?msg=1";</script>';
    }
    
?>