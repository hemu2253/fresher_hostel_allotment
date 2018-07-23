<?php

function connect_2_db()
{
	$host="localhost";  
	$username="root";  
	$password="PASSWORD";
	$db_name="fdha";
	$con = mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect"); 
	return $con;
}
