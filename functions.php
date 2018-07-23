<?php
$host="localhost";  
$username="root";  
$password="PASSWORD";

$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 

function isEmpty($value) //used in action files. Returns true if empty input is given.
{
	$result = false;
	if($value = "" || empty($value))
	{
		$result = true;
	}
	return $result;
}

function rooms_left()
{
	global $con;
	$db_name="fdha";
	mysqli_select_db($con, "$db_name")or die("cannot select DB");
	$q1 = mysqli_query($con, "SELECT room FROM hostel WHERE allow=1 AND allotted=0 AND gender='M'");
	$count1 = mysqli_num_rows($q1);
	$q2 = mysqli_query($con, "SELECT room FROM hostel WHERE allow=1 AND allotted=0 AND gender ='F'");
	$count2 = mysqli_num_rows($q2);
	$count[0] = $count1;
	$count[1] = $count2;
	return $count;
}

function sanitize_input($raw_input) //included in all files where user input is expected. Makes input SQL query safe.
{
	global $con;
	$raw_input = trim($raw_input);
	$raw_input = stripslashes($raw_input);
	$raw_input = htmlspecialchars($raw_input);
	$raw_input = mysqli_real_escape_string($con, $raw_input);
	return $raw_input;
}

function approver($username) //Included in all files. Approves access.
{
	global $con;
	$db_secure="fdha";
	mysqli_select_db($con, "$db_secure")or die("cannot select DB");
	//$memcache = memcache_connect('localhost', 11211);
	/*if($memcache)
	{
		$key = $username."_access";
		if($memcache->get($key))
		{
			$valid = new StdClass;
			$valid = $memcache->get($key);
			if($valid->approve == 'Y' )
			{
				if($_COOKIE['uac'] == $valid->uac)
				{
					return;
				}
				elseif($_COOKIE['uac'] != $valid->uac)
				{
					setcookie('error','3');
					$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/logout.php";
					header("location: $redirect");
					exit();
				}
			}
			elseif($valid->approve == 'N' )
			{
				setcookie('error','2');
				$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/logout.php";
				header("location: $redirect");
				exit();
			}
		}
		elseif(!$memcache->get($key))
		{
			setcookie('error','4');
			$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/logout.php";
			header("location: $redirect");
			exit();
		}	
	}
	else*/
	{	
		$querys=mysqli_query($con, "SELECT approve, uac FROM login WHERE user='$username'");
		$counts=mysqli_num_rows($querys);
		if($counts==1)
		{
			$row=mysqli_fetch_array($querys);
			if($row['approve']=='Y')
			{
				if($_COOKIE['uac']==$row['uac'])
				{
					return;
				}
				else if($_COOKIE['uac']!=$row['uac'])
				{
					setcookie('error','3');
					$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/logout.php";
					header("location: $redirect");
					exit();
				}	
			}
			else if($row['approve']=='N')
			{
				setcookie('error','2');
				$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/logout.php";
				header("location: $redirect");
				exit();
			}
		}
		else
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/logout.php";
			header("location: $redirect");
			exit();
		}
	}
}

function credits()
{
	echo "<div class='bits-strip-parent'>";
	echo "<div class='bits-strip' style='background-color: #ed1c24;'></div>"; //yellow
	echo "<div class='bits-strip' style='background-color: #6cbfe7; '></div>"; //blue
	echo "<div class='bits-strip' style='background-color: #faca2c;'></div>"; //red
	echo "</div>";
	
	echo "<div class='bits-logo-in-background'></div>";
	
	echo "<div class='credits'><b>Developed By: </b>Pranjal Kumar (2011B4A3618H)<br><b>Under the guidance of</b> Prof. V Vinayaka Ram and Dr. Kumar Pranav Narayan<br>&copy; 2015 Admission Division, BITS, Pilani - Hyderabad Campus</div>";
}
?>
