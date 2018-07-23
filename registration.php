<?php
	ob_start();
	require 'functions.php'
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>FDHA Registration</title>
		<meta name="description" content="For smoothing Admissions" />
		<meta name="keywords" content="basic stuff for admissions procedure php jscript css html SQL" />
		<meta name="author" content="Pranjal Kumar and Mayank Dharwa" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/topmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/sidemenu.css" />
		<link rel="stylesheet" type="text/css" href="css/notify.css" />
		<script src="js/modernizr.custom.js"></script>
		<style>
		#reg{
		margin: 0 auto;
		padding: 5em 2em;
		padding-left:  25%;
		background: rgba(225,225,225,0);
		}
		</style>
		</head>
	<body>
		<div class='container'>
			<ul id="gn-menu" class="gn-menu-main">
				<li><a class="gn-icon gn-icon-contact" href="contact.php">Contact Us</a></li>
				<li><a class="codrops-icon codrops-icon-logoff" href="logout.php"><span>Login</span></a></li>
			</ul>
			<header id='reg'>
				<?php
				$flag=false;//This is used in show_noti() to change the width of div box
				$ok=array(true,true,true,true,true); //Will be set to false if incorrect input is found in the below if-else loops
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$nameErr=""; $name=""; $pwdErr=""; $repwdErr=""; $pwd=""; $repwd=""; $domErr=""; $dom=""; $uname=""; $unameErr="";
					$phone=""; $phoneErr="";
					
					//check Name
					if (empty($_POST["name"]))
					{
						$nameErr = "Name is required";
						$ok[0]=false;
					}
					else if (!preg_match("/^[a-zA-Z ]*$/",$_POST["name"]))
					{
						$flag=true;
						$nameErr = "Only alphabets allowed.";
						$name="";
						$ok[0]=false;
					}
					else
					{
						$name = sanitize_input($_POST["name"]);
						$ok[0]=true;
					}
					
					
					//check username
					if (empty($_POST["username"]))
					{
						$unameErr = "Username is required";
						$ok[1]=false;
					}
					else if (!preg_match("/^[a-zA-Z0-9]*$/",$_POST["username"]))
					{
						$flag=true;
						$unameErr = "Only alphabets and numbers are allowed. No spaces.";
						$uname="";
						$ok[1]=false;
					}
					else if(strlen($_POST['username'])>24)
					{
						$unameErr = "Username too long.";
						$uname="";
						$ok[1]=false;
					}
					else
					{
						$uname = sanitize_input($_POST["username"]);
						$ok[1]=true;
					}
					
					
					//check password
					if(empty($_POST["password"]) || strlen($_POST["password"])<6)
					{
						$pwdErr = "Min password length is 6";
						$pwd="";
						$ok[2]=false;
					}
					else
					{
						$pwd = sanitize_input($_POST["password"]);
						$pwdErr="";
						$ok[2]=true;
					}
					
					
					//match password for confirmation
					if(empty($_POST["repass"]))
					{
						$repwdErr = "Required.";
						$ok[3]=false;
					}
					else if($pwd!=$_POST["repass"])
					{
						$repwdErr = "Passwords do not match";
						$pwd="";
						$ok[3]=false;
					}
					else
					{
						$repwd = sanitize_input($_POST["repass"]);
						$repwdErr = "";
						$ok[3]=true;
					}
					
					
					//check if domain is selected or not
					if(!isset($_POST['domain']))
					{
						$domErr="Domain is required.";
						$ok[4]=false;
					}
					else
					{
						$dom=$_POST['domain'];
						$ok[4]=true;
					}
					
					//check phone number
					if(empty($_POST["phone"]))
					{
						$phoneErr = "Required.";
						$ok[5]=false;
					}
					else if(strlen($_POST['phone'])!=10)
					{
						$phoneErr = "Invalid phone number";
						$ok[5]=false;
					}
					else
					{
						$phone = (string)sanitize_input($_POST["phone"]);
						$phoneErr="";
						$ok[5]=true;
					}
					//outputs success message if no error found. Also updates mysql tables.
					if($ok[0]==true && $ok[1]==true && $ok[2]==true && $ok[3]==true && $ok[4]==true && $ok[5]==true)
					{
						$passcode = hash('sha256', $pwd);
					//	$dom = "pywRNbEzS6tmnvzYReXWGyAd";
						success($name, $phone, $uname, $passcode);
						$name="";$phone="";$uname="";$pwd=""; $repwd="";
					}
				}
				else
				{
					$nameErr=""; $name=""; $pwdErr=""; $repwdErr=""; $pwd=""; $repwd=""; $domErr=""; $dom=""; $uname=""; $unameErr="";
					$phone=""; $phoneErr="";
				}?>
				<h1>Volunteer Registration<br></h1>
				<form action= "registration.php" method = "POST" name="form1" id="form1">
				<table border="0">
				<tr><td><br>Your Name: &nbsp;&nbsp;</td><td><br><input type="text" placeholder="Name" name="name" id="name" value="<?php echo $name;?>"></td><td><?php echo show_noti($nameErr);?></td></tr>
				
				<tr><td><br>Phone: &nbsp;&nbsp;</td><td><br><input type="number" placeholder="Phone" name="phone" id="phone" value="<?php echo $phone;?>"></td><td><?php echo show_noti($phoneErr);?></td></tr>
				
				<tr><td><br>Username: &nbsp;&nbsp;</td><td><br><input type="text" placeholder="Username" name="username" id="username" value="<?php echo $uname;?>"></td><td><?php echo show_noti($unameErr);?></td></tr>
				
				<tr><td><br>Password: &nbsp;&nbsp;</td><td><br><input type="password" placeholder="Password" name="password" id="password" value="<?php echo $pwd;?>"><br></td><td><?php show_noti($pwdErr);?></td></tr>
				
				<tr><td><br>Re-Enter Password: &nbsp;&nbsp;</td><td><br><input type="password" placeholder="Re-enter" name="repass" id="repass" value="<?php echo $repwd;?>"><br></td><td><?php show_noti($repwdErr);?></td></tr>
				
				<tr><td><br>Choose Domain: &nbsp;&nbsp;</td><td><br>
				<select name="domain">
				<option value="hostel">Hostel Allotment</option>
				</select></td><br><td><?php show_noti($domErr);?></td></tr>
				</table>
				<br>
				<input type="submit" value="Submit">
					
				<?php
								
				function show_noti($x)
				{
					global $flag;
					$sp="&nbsp;&nbsp;";
					if($x!="" && $flag==true)
					{
						echo "<div id='notibox' class='notify2'>";
						echo "<p id='notitext' class='notify-text'>".$sp.$x."</p></div>";
					}
					else if($x!="")
					{
						echo "<div id='notibox' class='notify'>";
						echo "<p id='notitext' class='notify-text'>".$sp.$x."</p></div>";
					}
					$flag=false;
					return;
				}
				
				function success($name, $phone, $uname, $pwd)
				{	
					$host="localhost";  
					$username="root";  
					$password="PASSWORD";
					$db_name="fdha";

					$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
					mysqli_select_db($con, "$db_name")or die("cannot select DB");
					
					$query = mysqli_query($con, "SELECT user FROM login WHERE user='$uname'");
					echo mysqli_error($con);
					$count=mysqli_num_rows($query);
					if($count==0)
					{
						mysqli_query($con, "INSERT INTO login (name, phone, user, pass) VALUES ('$name',$phone,'$uname','$pwd')");
						echo "<div id='successbox' class='notify-success'>";
						echo "<p class='notify-text'>Registration Complete.</h3><br>Please wait for admin approval before you login.</p></div>";
						//$error1=mysqli_error($con);
						//echo "<p class='notify-text'>".$error1."</h3><br>Please wait for admin approval before you login.</p></div>";
					}
					else
					{
						echo "<div id='successbox' class='notify-success'>";
						echo "<p class='notify-text'>Username already exists.</h3><br>Please select a different username.</p></div>";
					}
					return;
				}?>
			</header>
			<script>
				var myBox = document.getElementById('successbox');
				myBox.addEventListener('webkitAnimationEnd',function( event ) { myBox.style.display = 'none'; }, false);
				var myBox = document.getElementById('notibox');
				myBox.addEventListener('webkitAnimationEnd',function( event ) { myBox.style.display = 'none'; }, false);
			</script>
						
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		<?php credits(); ?>
	</body>
</html>
<?php ob_end_flush(); ?>
