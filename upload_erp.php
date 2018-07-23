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
	
	//File Upload CSV
	
	require 'global_vars.php';
	$con = connect_2_db();
	
	mysqli_query($con, "TRUNCATE TABLE erp_data"); //clean student list
	
	
	if(is_uploaded_file($_FILES['studlist']['tmp_name']))
	{
		$fileloc = $_FILES["studlist"]["tmp_name"];
		$fp = fopen($fileloc, "r");
		$h=0;
		$lc=0;
		$room_table_vals = array("");
		$c0 = $c1 = $c2 = $c3 = $c4 = $c5 = false;
		while(!feof($fp))
		{
			$line = fgetcsv($fp);
			if(sizeof($line)== 6)
			{
				$c0 = check($line[0],"uid");
				$c1 = check($line[1],"uid");
				$c2 = check($line[2],"uid");
				$c3 = check($line[3],"uid");
				$c4 = check($line[4],"uid");
				$c5 = check($line[5],"uid");
				if($c0 && $c1 && $c2 && $c3 && $c4 && $c5)
				{
					$rvs[0] = sanitize_input($line[0]);
					$rvs[1] = sanitize_input($line[1]);
					$rvs[2] = sanitize_input($line[2]);
					$rvs[3] = sanitize_input($line[3]);
					$rvs[4] = sanitize_input($line[4]);
					$rvs[5] = sanitize_input($line[5]);
					$room_table_vals[$h] = "('".implode("','",$rvs)."')";
					$h++;
					$lc++;
				}
				else
				{
					echo "<br>Error in Line ".($lc+1)." The line was skipped.";
					$lc++;
				}
			}
			else
			{
				echo "<br>Error in Line ".($lc+1)." The line was skipped.";
				$lc++;
			}
		}
		fclose($fp);
		mysqli_query($con, "INSERT IGNORE INTO erp_data (ApplicationNumber, IDNumber, name, gender, degree, branch) VALUES ".implode(",",$room_table_vals));
		if(strlen(mysqli_error($con))>0)
			echo "<br>".mysqli_error($con);
		else
			echo "<br>Users Added to rooms database";
		
		setcookie("uploads","1");
		
		//header("location:admin.php");
	}
	
	function check($input, $case)
	{
		$op = false;
		switch($case)
		{
			case "uid":		if(preg_match("/^[a-zA-Z0-9 .]*$/", $input) && $input!="")
							$op = true;
							break;
		}
		return $op;
	}
	
?>