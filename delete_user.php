<?php
	
	session_start();
	$dict1 = $_SESSION['dict1'];
	
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn , 'registers');
	
	
	$x = $_GET['u_id'];
	
	$t = "delete from registrations where uname = '$dict1[$x]' ";
	$result = mysqli_query($conn , $t);

	$t = "delete from jobs where uname = '$dict1[$x]' ";
	$result = mysqli_query($conn , $t);
	
?>