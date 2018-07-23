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
	}
	require 'functions.php';
	approver($_SESSION['myusername']);
	
	$host="localhost";  
	$username="root";  
	$password="PASSWORD";
	$db_name="fdha";

	$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysqli_select_db($con, "$db_name")or die("cannot select DB");
	$table = "hostel";

	date_default_timezone_set("Asia/Kolkata"); //setting default time-zone to India.

	$query1 = mysqli_query($con,"SELECT pid FROM hostel where allotted =0 AND gender='M'");
	$query2 = mysqli_query($con,"SELECT pid FROM hostel where allotted =0 AND gender='F'");
	$boys = mysqli_num_rows($query1);
	$girls = mysqli_num_rows($query2);
	echo json_encode(array('boys'=>$boys,'girls'=>$girls));
?>
