<?php
$server="localhost";
$user="root";
$password="";
$db="db_saloon";
$con=mysqli_connect($server,$user,$password,$db);
if(!$con)
{
	echo"connection failed";
}
?>