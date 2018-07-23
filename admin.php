<?php
	session_start();
	if(!isset($_SESSION['myusername']))
	{
		if(!isset($_COOKIE['uac']))
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/hostel/fdha/index.php";
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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Hostel Allotments</title>
		<link rel="stylesheet" type="text/css" href="css/ha.css" />
		<link rel="stylesheet" type="text/css" href="css/elements.css" />
		<link rel="stylesheet" type="text/css" href="css/admin.css" />
		<link rel="stylesheet" type="text/css" href="css/topmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/sidemenu.css" />
		<script src="js/modernizr.custom.js"></script>
		<style>
		.table-box
		{
			position: relative; float: left;
			margin-left: 1%;
			padding-top: 0px;
			width: 100%;
			height: auto;
			z-index:0;
			font-family: helvetica;
			overflow-y:auto;
			background-color: rgba(255,255,255,0.5);
		}
		.container>header th
		{
			text-align: center;
		}
		.color1
		{
			position: relative;
			width: 140px;
			text-align: center;
			background-color: rgba(205,205,0,0.4);
		}
		.color3
		{
			position: relative;
			width: 126px;
			text-align: center;
			background-color: rgba(205,205,0,0.4);
		}
		.color2
		{
			position: relative;
			width: 140px;
			text-align: center;
			background-color: rgba(255,100,0,0.4);
		}
		.color4
		{
			position: relative;
			width: 129px;
			text-align: center;
			background-color: rgba(255,100,0,0.4);
		}
		</style>
	</head>
	<body>
		<header>
			<a href='index.php'>
			<div class='bits-logo'>
				<img src='img/bitslogo.png' class='bits-logo' style = "width:75px;" />
				<span>BITS Pilani<br><p>Hyderabad Campus</p></span>
			</div></a>
			<div class='menu'><a href='logout.php'><span class='codrops-icon codrops-icon-logoff'> Logout</span></a></div>
		</header>
		<div class='container'>
			<div class='commons' style='height: 100%;'>
				<h2 style='padding-top: 10px;'>ADMIN PANEL</h2>
				<div class='adminleft'>
					Import CSV
					<br>
					<form action="upload_erp.php" method="post" enctype="multipart/form-data">
					<input type="file" name="studlist" id="list" accept=".csv" required='required'>
					<input type="submit" value="Upload Student List" name="submitstu" class="stulist">
					</form>
					<br>
					<br>
					CSV Format: [ApplicationNumber][IDNumber][NAME][Gender][Degree][Branch]
					<br>
					<?php
						if(isset($_COOKIE['uploads']))
						{
							if($_COOKIE['uploads'] == "1")
							{
								echo " New Student List Uploaded &nbsp";
								setcookie('uploads','',time()-120);
							}
						}
						else
						{
							$con = connect_2_db();
							$data = mysqli_query($con,"SELECT pid FROM erp_data");
							$count = mysqli_num_rows($data);
							if($count > 10)
							{
								echo "Student List Uploaded &nbsp";
							}
							mysqli_close($con);
						}
					?>
					<form action="upload_room.php" method="post" enctype="multipart/form-data">
					<input type="file" name="roomlist" id="list" accept=".csv" required='required'>
					<input type="submit" value="Upload Room List" name="submitroom" class="stulist">
					</form>
					<br>
					<br>
					CSV Format: [ROOM][HID][Allow][Gender]
					<br>
					<?php					
					if(isset($_COOKIE['uploadr']))
					{
						if($_COOKIE['uploadr'] == "1")
						{
							echo "New Room List Uploaded";
							setcookie('uploadr','',time()-120);
						}
					}
					else
					{
						$con = connect_2_db();
						$data = mysqli_query($con,"SELECT room FROM hostel");
						$count = mysqli_num_rows($data);
						if($count > 10)
						{
							echo "Room List Uploaded";
						}
						mysqli_close($con);
					}
					?>	
				</div>
				<div class = 'adminright'>
					DOWNLOAD ALLOTMENTS
					<br>
					<br>
					<a href='expbh.php' name="reset" id="reset" class='stulist1'>BOYS LIST</a>
					<br>
					<br>
					<a href='expgh.php' name="reset" id="reset" class='stulist1'>GIRLS LIST</a>
				</div>
				<br>
				<div class = 'updates'>
					User Approval
					<form action="approve_actions.php" method="POST">
					<div style="position: relative; float: left;margin-left: 1%;">
						<table border="1">
						<tr style="position:relative; width:100%;">
						<th rowspan=2 style="width:240px;">NAME</th>
						<th rowspan=2 style="width:240px;">USERNAME</th>
						<th rowspan=1 colspan="2" style="width:480px;">APPROVE</th>
						<th rowspan=1 colspan="2" style="width:480px;">DOMAIN</th>
						<th rowspan=2 style="width:240px;">DELETE</th>
						</tr>
						<tr>
						<th style="width=120px;position:relative;">YES</th>
						<th style="width=120px;position:relative;">NO</th>
						<th style="width=120px;position:relative;">ADM</th>
						<th style="width=120px;position:relative;">HOS</th>
						</table>
					</div>
					<div class="table-box">
						<table border="1">	
						<?php
						$host="localhost";  
						$username="root";  
						$password="PASSWORD";
						$db_name="fdha";
						$tbl1="login";
						$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
						mysqli_select_db($con, "$db_name")or die("cannot select DB");
						
						$querya = mysqli_query($con,"SELECT * FROM $tbl1");
						
						while($vol = mysqli_fetch_array($querya))
						{
							$usrname=$vol['user'];
							$oname=$vol['name'];
							//$approve = 'N';
							if($vol['approve']=='Y')
							{
								$approve='Y';
							}
							else if($vol['approve']=='N')
							{
								$approve='N';
							}
							if($vol['uac'] == "L2ThQk4r6JSDvHLLW67jZRT2")
							{
								$domain = "admin";
							}
							else if($vol['uac'] == "pywRNbEzS6tmnvzYReXWGyAd")
							{
								$domain = "hostel";
							}
								print_form($oname, $usrname, $approve, $domain);
						}	
						function print_form($name, $uname , $app, $dom)
						{
							$c1=$c2=$c3=$c4=$c5=$c6=$c7=$c8=$c9=$c10="";
							$ay=$an="";
							switch($app)
							{
							case 'Y': $ay="checked"; break;
							case 'N': $an="checked"; break;
							}
							switch($dom)
							{
								case 'admin': $c1="checked"; break;
								case 'hostel': $c2="checked"; break;
							}
							echo"<tr class='table-highlight'>
							<td style='width:240px;'>".$name."</td>
							<td style='width:240px;'>".$uname."</td>
							<td class='color1'><input type='radio' class='fake' name='".$uname."_app' value='Y' ".$ay."></td>
							<td class='color3'><input type='radio' class='fake2' name='".$uname."_app' value='N' ".$an."></td>
							<td class='color2'><input type='radio' name='".$uname."_dom' value='admin' ".$c1."></td>
							<td class='color4'><input type='radio' name='".$uname."_dom' value='hostel' ".$c2."></td>
							<td style='width:240px; text-align: center;'><input type='checkbox' name='".$uname."_del' value='Y'>";
						}				
						?>
						
						</table><br>
						<table>
						<tr><td style="width: 1160px; text-align: center;"><input  name="submit" type="submit" value="UPDATE" class="button"></form>
						</table>
					</div>
				</div>	
		</div> <!--container-->
	</body>
</html>
