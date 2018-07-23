<?php
	session_start();
	if(isset($_SESSION['myusername']))
	{
		if(isset($_COOKIE['uac']))
		{
			$redirect = "http://".$_SERVER['SERVER_NAME']."/fdha/main.php";
			header("location: $redirect");
			exit();
		}	
	}
?>	
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>BITS FD Hostel Allotments</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Pranjal Kumar" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/login.css" />
		<link rel="stylesheet" type="text/css" href="css/notify.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
		#logo{
		height: 220px;
		width: 220px;
		position: relative;
		left: -300px;
		top: 80px;
		}
		#pos1{
		position: relative;
		left: -300px;
		top: 80px;
		}
		#pos2{
		position: relative;
		left: -300px;
		top: 80px;
		}
		#pos3{
		position: relative;
		left: -300px;
		top: 80px;
		}
		</style>
    </head>
    <body>
	    <div class="container">
			<header>
				<br>
				<br>
				<img id='logo' src="./img/bitslogo.png">
				<h1 id='pos1'>BITS Pilani</h1>
				<h2 id='pos2'>Admissions</h2>
				<h3 id='pos3'>Hostel Allotments</h3>
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>		
			</header>
			<section class="main">
				<form class="form-3" method="POST" action="checklogin.php" name="form1">
					<p class="clearfix">
						<input type="text" name="login" id="login" placeholder="Username">
					</p>
					<p class="clearfix">
						<input type="password" name="password" id="password" placeholder="Password"> 
					</p>
					<p class="clearfix">
						 <a href="registration.php">New user?<br>Register Here</a>
					</p>
					<p class="clearfix">
						<input type="submit" name="submit" value="Sign in">
					</p>
					<?php
					if (isset($_COOKIE["error"]))
					{
						if ($_COOKIE["error"]=="1")
						{
							echo "<h3>Invalid username or password!</h3>";
						}
						elseif($_COOKIE["error"]=="2")
						{
							echo "<h3>Administrator Approval Pending!</h3>";
						}
						elseif($_COOKIE["error"]=="3")
						{
							echo "<h3>Your access has been changed.Contact Admin!</h3>";
						}
						elseif($_COOKIE["error"]=="4")
						{
							echo "<h3>Session has expired. Login again</h3>";
						}
						setcookie("error","",time()-120);
					}
					?>	
				</form>
				<!---This puts the focus on the text-box, so you don't have to click it to type--->
				<script>
					document.forms["form1"].elements["login"].focus();
				</script>
			</section>
		</div>
	<div class='credits'><a href='https://www.positivessl.com' style='font-family: arial; font-size: 10px; color: #212121; text-decoration: none;'><img src='https://www.positivessl.com/images-new/PositiveSSL_tl_trans.png' alt='SSL Certificate' title='SSL Certificate' border='0' /></a></div></div>;	
	</body>
</html>