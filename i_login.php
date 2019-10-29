
<?php
	session_start();
	if (isset($_POST['submit']))
	{
		
		session_start();
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn , 'registers');
		
		$uname = $_POST['username'];
		$_SESSION['username'] = $uname;
		$pass = $_POST['pass'];
		$_SESSION['password'] = $pass;
	
		$s = "Select * from registrations where uname = '$uname' and pass = '$pass' ";
		$result = mysqli_query($conn , $s);
		$n = mysqli_affected_rows($conn);
		if ($n == 1)
		{
			header('Location: user.php');
		}
		else
		{
			$t = "select * from admins where uname = '$uname' and pass = '$pass' ";
			$res = mysqli_query( $conn , $t);
			$n = mysqli_affected_rows($conn);
			if ( $n == 1 )
			{
				header('Location: admin.php');
			}
			else	
			{
				header('Location: i_login.php');
			}
		}
	}
	
 ?>



<html>
	<head>
<title>Printer</title>
<link href="sustyle.css" type="text/css" rel="stylesheet">
</head>
<body>
<header>
	<div>
        <h1 class="mheader" align = "center"> CRCE PRINT</h1>
    </div>

	<div class='form'>
	<h1 class='signup' align="center">Sign Up to Access Printers</h1>
	<form align="center" method='POST' action="">
		<input type="text" name="username" size="20" style="border-bottom: 3px solid #f80000;" maxlength="30" class="uname" placeholder="Username" required>
		<br>
		<input type="password" name="pass" style="border-bottom: 3px solid #f80000;" class="psswd"  placeholder="Password" required>
		<br>
		<input type="submit" value="Login" name='submit' id='submit'class='submit'><br>
		<span>Not a user? <a class="su" href="signup.php">Sign up</a></span>
	</form>
	</div>


</div>
</header>

</body>
</html>