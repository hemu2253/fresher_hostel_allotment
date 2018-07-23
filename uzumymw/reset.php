<?php
	session_start();
	if(!isset($_SESSION['myusername']))
	{
		if(!isset($_COOKIE['uac']))
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/index.php";
			header("location: $redirect");
			exit();
		}	
	}else if(isset($_SESSION['myusername']))
	{
		if (!($_COOKIE['uac']=="q6aN3MUuQZS3QZyoM31ytT8W"))
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/main.php";
			header("location: $redirect");
			exit();
		}	
	}
	require '../functions.php';
	approver($_SESSION['myusername']);
?>
<?php
if($_GET['p'] == "dMiRNyPHlRSvJrj")
{
	$host="localhost";  
	$username="user3";  
	$password="Fr*x+chAsT5SpUY2*Ac6ep#A";
	$db_name="applicant_record";

	$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysqli_select_db($con, "$db_name")or die("cannot select DB");

	date_default_timezone_set("Asia/Kolkata"); //setting default time-zone to India.

	mysqli_query($con, "UPDATE bh SET allotted = 0, ApplicationNumber = null, Time= null WHERE allotted = 1");
	mysqli_query($con, "UPDATE gh SET allotted = 0, ApplicationNumber = null, Time= null WHERE allotted = 1");
	for($i=1; $i<=12;$i++)
	{
		mysqli_query($con, "UPDATE counter SET count = 0 WHERE PID = $i");
		mysqli_query($con, "UPDATE passed SET passed = 0 WHERE PID = $i");
		mysqli_query($con, "UPDATE status SET status = 1 WHERE PID = $i");
	}
	mysqli_query($con, "TRUNCATE TABLE docvalid"); 
	mysqli_query($con, "TRUNCATE TABLE photo_finger");
	
	mysqli_query($con, "TRUNCATE TABLE q01");
	mysqli_query($con, "TRUNCATE TABLE q02");
	mysqli_query($con, "TRUNCATE TABLE q03");
	mysqli_query($con, "TRUNCATE TABLE q04");
	mysqli_query($con, "TRUNCATE TABLE q05");
	mysqli_query($con, "TRUNCATE TABLE q06");
	mysqli_query($con, "TRUNCATE TABLE q07");
	mysqli_query($con, "TRUNCATE TABLE q08");
	mysqli_query($con, "TRUNCATE TABLE q09");
	mysqli_query($con, "TRUNCATE TABLE q10");
	mysqli_query($con, "TRUNCATE TABLE q11");
	mysqli_query($con, "TRUNCATE TABLE q12");
	
	mysqli_query($con, "TRUNCATE TABLE studata");
	mysqli_query($con, "TRUNCATE TABLE track");
	mysqli_query($con, "TRUNCATE TABLE token");
	mysqli_query($con, "TRUNCATE TABLE track_all");
	echo "DATA RESET.";
}
else if(!(isset($_GET['p'])))
{
echo "<h1>INVALID PASSWORD ACCESS UNAUTHORISED!</h1>";
}
else if($_GET['p'] != "dMiRNyPHlRSvJrj")
{
echo "<h1>INVALID PASSWORD ACCESS UNAUTHORISED!</h1>";
}
?>
