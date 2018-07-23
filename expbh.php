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
	require 'global_vars.php';
	approver($_SESSION['myusername']);
	
$host="localhost";  
$username="root";  
$password="PASSWORD";
$db_name="fdha";

$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($con, "$db_name")or die("cannot select DB");

date_default_timezone_set("Asia/Kolkata"); //setting default time-zone to India.

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=boyshostel.csv');

$output = fopen('php://output', 'w');

//time

//headings
fputcsv($output, array('Application Number', 'ID', 'Name', 'Branch', 'Room'));

$query = mysqli_query($con, "SELECT hostel.ApplicationNumber, erp_data.IDNumber, erp_data.Name, erp_data.Branch AS branch, hostel.room FROM hostel INNER JOIN erp_data ON hostel.ApplicationNumber = erp_data.ApplicationNumber WHERE hostel.gender = 'M'");
for($r=0;$r<14;$r++)
{
	$count[$r] = 0;
}
while($row = mysqli_fetch_assoc($query))
{
	$b = $row['branch'];
	switch($b)
	{
		case 'A1H': $count[0]++; break;
		case 'A2H': $count[1]++; break;
		case 'A3H': $count[2]++; break;
		case 'A4H': $count[3]++; break;
		case 'A5H': $count[4]++; break;
		case 'A7H': $count[5]++; break;
		case 'A8H': $count[6]++; break;
		case 'AAH': $count[7]++; break;
		case 'ABH': $count[8]++; break;
		case 'B1H': $count[9]++; break;
		case 'B2H': $count[10]++; break;
		case 'B3H': $count[11]++; break;
		case 'B4H': $count[12]++; break;
		case 'B5H': $count[13]++; break;
	}
	fputcsv($output, $row);
}
fputcsv($output, Array(""));
fputcsv($output, array("Boys Admitted in A1",$count[0]));
fputcsv($output, array("Boys Admitted in A2",$count[1]));
fputcsv($output, array("Boys Admitted in A3",$count[2]));
fputcsv($output, array("Boys Admitted in A4",$count[3]));
fputcsv($output, array("Boys Admitted in A5",$count[4]));
fputcsv($output, array("Boys Admitted in A7",$count[5]));
fputcsv($output, array("Boys Admitted in A8",$count[6]));
fputcsv($output, array("Boys Admitted in AA",$count[7]));
fputcsv($output, array("Boys Admitted in AB",$count[8]));
fputcsv($output, array("Boys Admitted in B1",$count[9]));
fputcsv($output, array("Boys Admitted in B2",$count[10]));
fputcsv($output, array("Boys Admitted in B3",$count[11]));
fputcsv($output, array("Boys Admitted in B4",$count[12]));
fputcsv($output, array("Boys Admitted in B5",$count[13]));
fclose($output);
?>