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
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>FD Hostel Allotment</title>
		<meta name="description" content="For smoothing Hostel Allotments" />
		<meta name="keywords" content="basic stuff for admissions procedure php jscript css html SQL" />
		<meta name="author" content="Pranjal Kumar" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/topmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/sidemenu.css" />
		<link rel="stylesheet" type="text/css" href="css/notify.css" />
		<script src="js/modernizr.custom.js"></script>
		<script src="js/jquery.min.js"></script>
		<style>
			td {
				height: 35px;
			}
			body {
				overflow-y: hidden;
			}
			#data{
				font-size : 16px;
				font-family: helvetica;
			}
		</style>
	</head>
	<body>
		<script language="javascript" type="text/javascript"> 
			$(document).keypress(function(event){
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					$('#btn').click();
				}
			});
		</script>
		<div class='container'>
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger"><a class="gn-icon gn-icon-menu"><span>Menu</span></a></li>
				<li><a href="main.php"><span>home</span></a></li>
				<?php
					if(isset($_SESSION['myusername'])) {
						echo "<li><a><span>".$_SESSION['myusername']."</span></a></li>";
						if($_COOKIE['uac']=="L2ThQk4r6JSDvHLLW67jZRT2") {
							echo "<li><a href='admin.php'><span>Admin</span></a></li>";
						}
					}
				?>
				<li><a class="codrops-icon codrops-icon-logoff" href="logout.php"><span>logout</span></a></li>
			</ul>
			<header>
				<h1>HOSTEL ALLOTMENT</h1><br>
					<form id='#form1' name='form2' onsubmit="return false">
					Application Number: &nbsp; <input type = "number" id = "box" required autofocus><br><br>
					<button type="button" id="btn">Submit</button>
					<p id = "data"></p>
					</form>
				<h3>
					<?php
						$count = rooms_left();
						echo "<div class='notify-hostel' id='ctbox1'>";
						echo "<p class='hostel-text'>Rooms Left in:<br>Boys Hostel:</p><h1 class='hostel-text' id ='boy-value'>".$count[0]."</h1>";
						echo "</div><div class='notify-hostel' id='ctbox2'>";
					?>
					<script>
						var div = document.getElementById('ctbox2');
						div.style.right = '30px';
						div.style.background = 'orange';
					</script>
					<?php
						echo "<p class='hostel-text'>Rooms Left in:<br>Girls Hostel:</p><h1 class='hostel-text' id='girl-value'>".$count[1]."</h1>";
						echo "</div>";
					?>
				</h3>
				<!---This puts the focus on the text-box, so you don't have to click it to type--->
			</header>
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		<script language="javascript" type="text/javascript">
			$("#btn").click(function(){
				var app = box.value;
				$.post("hostel_actions.php",{appno: app}, function (ev) {
					var msg = JSON.parse(ev); //read sent data
					var error = msg.error;
					if(error == 1)
					{
						alert(msg.code);
						$('#box').val('');
					}
					else if(error == 0)
					{
						var name = msg.name;
						var application = msg.appno;
						var room = msg.room;
						var idnum = msg.idnum;
						var gender = msg.gender;
						var txt =
							"<b>Application Number:</b> " + application +
							"<b><br>Name:</b> " + name +
							"<b><br>ID Number:</b> " + idnum +
							"<b><br>Allotted Room:</b> " + room +
							"<b><br>Gender:</b> " + gender;
						$('#data').html(txt);
						$('#box').val('');
					}
				});
				$.get("hostel_status.php",function(data){
					var val = JSON.parse(data);
					var boys = val.boys;
					var girls = val.girls;
					$('#boy-value').text(boys);
					$('#girl-value').text(girls);
				});	
			});
		</script>
		<?php credits(); ?>
	</body>
</html>