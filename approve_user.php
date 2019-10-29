<?php
	
	session_start();
	$dict = $_SESSION['dict_ujobs'];
	
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn , 'registers');
	
	
	$x = $_GET['u_id'];
    
	$t = "update jobs set approved = 'approved' where uname = '$dict[$x]' ";
    $result = mysqli_query($conn , $t);

    
?>