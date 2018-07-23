<?php
ob_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="PASSWORD"; // Mysql password 
$db_name="fdha"; // Database name 
$tbl_name="login"; // Table name 

require "functions.php";

// Connect to server and select database.
$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($con, "$db_name")or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername=$_POST['login']; 
$mypassword=$_POST['password']; 
// To protect MySQL injection
//sanitize_input(string) defined in functions.php
$myusername = sanitize_input($myusername); 
$mypassword = sanitize_input($mypassword);
$passcode = hash('sha256', $mypassword );
session_start();
//$memcache = memcache_connect('localhost', 11211);
//check if memcache exists
if($memcache)
{
	//create the map key of login variable and check its existance
	$key1 = $myusername."_access";
	if($memcache->get($key1))
	{
		$read  = new StdClass;
		$read = $memcache->get($key1);
		if($read->password == $passcode)
		{
			if($read->approve == 'Y')
			{
				$_SESSION["myusername"] = $myusername;
				$_SESSION["mypassword"]=$mypassword; 
				$_SESSION["count"]=$count;
				setcookie("uac",$read->uac);
				header("location:main.php");
			}
			else
			{
				setcookie('error',"2");
				header("location:index.php");
			}
		}
		else
		{
			setcookie('error',"1");
			header("location:index.php");	
		}
	}
	else
	{
		$result = mysqli_query($con, "SELECT user,pass,uac,approve FROM $tbl_name WHERE user='$myusername' and pass='$passcode'");
		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result);
		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1)
		{
			// Register $myusername, $mypassword and redirect to file "main.php"
			$row = mysqli_fetch_array($result);
			$uac=$row["uac"];
			setcookie("uac","$uac");
			$_SESSION["myusername"]=$myusername;
			$_SESSION["mypassword"]=$mypassword; 
			$_SESSION["count"]=$count;
			$send = new StdClass;
			$send->password = $row['pass'];
			$send->approve = $row['approve'];
			$send->uac = $row['uac'];
			$memcache ->set($key1,$send);
			header("location:main.php");
		}
		else
		{
			setcookie("error","1");
			header("location:index.php");
		}
	}	
}
else
{
	$result = mysqli_query($con, "SELECT user,pass,uac,approve FROM $tbl_name WHERE user='$myusername' and pass='$passcode'");
	// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1)
	{
		// Register $myusername, $mypassword and redirect to file "main.php"
		$row = mysqli_fetch_array($result);
		$uac=$row["uac"];
		setcookie("uac","$uac");
		$_SESSION["myusername"]=$myusername;
		$_SESSION["mypassword"]=$mypassword; 
		$_SESSION["count"]=$count;
		header("location:main.php");
	}
	else
	{
		setcookie("error","1");
		header("location:index.php");
	}
}
ob_end_flush();
?>