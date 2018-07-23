<?php
	session_start();
	if(!isset($_SESSION['myusername']))
	{
		if(!isset($_COOKIE['uac']))
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/index.php";
			header("location: $redirect");
			exit();
		}	
	}else if(isset($_SESSION['myusername']))
	{
		if (!($_COOKIE['uac']=="L2ThQk4r6JSDvHLLW67jZRT2"))
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/main.php";
			header("location: $redirect");
			exit();
		}	
	}
	require 'functions.php';
	approver($_SESSION['myusername']);
	$host="localhost";  
	$username="root";  
	$password="PASSWORD";
	$db_name="fdha";
	$tbl1="login";
	$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysqli_select_db($con, "$db_name")or die("cannot select DB");
	$querya = mysqli_query($con,"SELECT * FROM $tbl1");
	//$memcache = memcache_connect('localhost', 11211);
	while($vol=mysqli_fetch_array($querya))
	{
		$approve=$vol['user']."_app";
		$domain=$vol['user']."_dom";
		$del=$vol['user']."_del";	
		$usrname = $vol['user'];
		$uac="abcd";
		if($_POST[$domain] == "admin")
		{
			$uac = "L2ThQk4r6JSDvHLLW67jZRT2";
		}
		else if($_POST[$domain] == "hostel")
		{
			$uac = "pywRNbEzS6tmnvzYReXWGyAd";
		}
		if($memcache)
		{
			$key = $vol['user']."_access";
			if($memcache->get($key))
			{
				if(isset($_POST[$del]) && $_POST[$del]=='Y')
				{
					$memcache->delete($key);
				}
				else
				{
					$send = new StdClass;
					$send->uac = $uac;
					$send->password = $vol['pass'];
					$send->approve=$_POST[$approve];
					$memcache->set($key,$send);
				}
			}
			else if(!isset($_POST[$del]))
			{
				$send = new StdClass;
				$send->uac = $uac;
				$send->password = $vol['pass'];
				$send->approve=$_POST[$approve];
				$memcache->set($key,$send);
			}	
		}
		if(isset($_POST[$del]) && $_POST[$del]=='Y')
		{
			mysqli_query($con, "DELETE FROM $tbl1 WHERE user='$usrname' ");
			mysqli_error($con);
		}
		else
		{
			$up = $_POST[$approve];
			mysqli_query($con, "UPDATE $tbl1 SET approve='$up' , uac='$uac' WHERE user='$usrname' ");
			mysqli_error($con);
		}
	}
	header("location:admin.php");
?>