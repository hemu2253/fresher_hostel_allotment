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

$isInvalid = false;
$isEmpty = isEmpty($_POST["appno"]);
$appno = sanitize_input($_POST["appno"]);

$table = "hostel";

date_default_timezone_set("Asia/Kolkata"); //setting default time-zone to India.

//checking if applicant is already allotted a room in either hostel.
if($isEmpty == false)
{
	$appno = (int) $appno;
	$query= mysqli_query($con, "SELECT room FROM $table WHERE ApplicationNumber=$appno");
	$num_rows=mysqli_num_rows($query);
	if($num_rows!=0)
	{
		$row = mysqli_fetch_array($query);
		$room = $row['room'];
		$queryn= mysqli_query($con, "SELECT name, IDNumber,gender FROM erp_data WHERE ApplicationNumber=$appno");		
		$rown=mysqli_fetch_array($queryn);
		$name = $rown["name"];
		$idnum = $rown["IDNumber"];		
		$gen = $rown['gender'];
		echo json_encode(array('error'=>0,'appno'=>$appno,'room'=>$room,'name'=>$name,'idnum'=>$idnum,'gender'=>$gen));
		exit();
	}
}
else
{
	
	$isInvalid = true;
	echo json_encode(array('error'=>1,'code'=>"data is empty"));
}

//For applicants not allotted a room, application is checked against erp data.
if($isInvalid == false)
{
	$query1= mysqli_query($con, "SELECT name, IDNumber, gender,degree FROM erp_data WHERE ApplicationNumber=$appno");
	$num_rows1=mysqli_num_rows($query1);
	$row1=mysqli_fetch_array($query1);
	if($num_rows1==0)
	{
		echo json_encode(array('error'=>1,'code'=>"Application Number does not exist in database"));
		$isInvalid = true;
		//does not exist in erp data.
	}
	else if ($num_rows1>1)
	{
		echo json_encode(array('error'=>1,'code'=>"Multiple entries for the given Application",'appno'=>$appno));
		$isInvalid = true;
		//Multiple entries -> Database compromised.
	}
}
//If no invalid input found -> Proceed to allotment.
if($isInvalid == false)
{
	$query1= mysqli_query($con, "SELECT name, IDNumber, gender,degree FROM erp_data WHERE ApplicationNumber=$appno");
	$num_rows1=mysqli_num_rows($query1);
	$row1=mysqli_fetch_array($query1);
	$deg=$row1['degree'];
	$name=$row1['name'];
	$idnum=$row1['IDNumber'];
	$gen = $row1['gender'];
	$query2 = mysqli_query($con,"SELECT room FROM $table WHERE allow=$deg AND allotted=0 AND gender ='$gen'");
	$num_rows2 = mysqli_num_rows($query2);
	if($num_rows2 != 0)
	{
		/*decrement the number since index starts from 0*/
		$num_rows2--;
		/*pick a random number representing a row.*/
		$r = mt_rand(0,$num_rows2);
		/*seek the pointer to that row in the table.*/
		mysqli_data_seek($query2,$r);
		/*fetch that row as array*/
		$row2 = mysqli_fetch_array($query2);
		
		$room = $row2['room'];
		$time=date('H:i:s');
		mysqli_query($con, "UPDATE hostel SET ApplicationNumber=$appno, allotted=1, time='$time' WHERE room='$room'");
		echo mysqli_error($con);
		echo json_encode(array('error'=>0,'appno'=>$appno,'room'=>$room,'name'=>$name,'idnum'=>$idnum,'gender'=>$gen));
		//room allotted.
	}
	else
	{
		echo json_encode(array('error'=>1,'code'=>"No Rooms left"));
		//no rooms left.
	}
}
?>
