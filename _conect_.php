<?php // teste gsafdasfafdsa

$connect = mysqli_connect('localhost','root','rvlav207300@R');
$db = mysqli_select_db($connect, 'gz_cmms');


	mysqli_set_charset($connect,'utf8');
	mysqli_query($connect,"SET NAMES utf8");
mysqli_query($connect,"SET CHARACTER SET utf8");
mysqli_query($connect,"set_charset('utf8')"); 

   

 
?>

