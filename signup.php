<?php
	if (isset($_POST['submit']))
	{
		session_start();
		$conn = mysqli_connect('localhost','root','');
		mysqli_select_db($conn , 'registers');
	
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$uname = $_POST['uname'];
		$roll = $_POST['roll'];
		$pass = $_POST['pass'];
	
		$s = "select * from registrations where uname = '$uname' ";
		$result = mysqli_query($conn,$s);
		$n = mysqli_affected_rows($conn);
		if ($n == 1)
		{
			echo "User NAme TAKEN";
		}
		else
		{
			$t = "insert into registrations values ('$fname','$lname','$uname','$roll','0','$pass')";
			mysqli_query($conn , $t);
			echo "Signed up successfully";
		}
	}
 ?>
 
<html>
<head>
    <title>Sign up for printing</title>
    <link href="sustyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <div>
            <h1 class="mheader" align = "center"> CRCE PRINT</h1>
        </div>

                
    <div class="form">
    <h1 class='signup' align="center">Sign Up to Access Printers</h1>
    
    <form align="center" method='POST' action="">
        
        <input type="text" size="10" maxlength="15" name="fname" class="form" placeholder="First Name" required><br>
        <input type="text" size="10" maxlength="15" name="lname" class="form" placeholder="Last Name" required><br>
        <input type="text" size="10" maxlength="15" name="uname" class="form" placeholder="Username" required><br>
        <input type="text" size="10" maxlength="15" name="roll" class="form"  placeholder="Roll no." required><br>
        <input type="password" size="20" maxlength="20" name="pass" class="form" placeholder="Password"><br>
        <input type="password" size="20" maxlength="20" name="cpass" class="form" placeholder="Re-confrim Password"><br>
        

        <input type="submit" value="Sign Up" name='submit' class='submit'></input> <br>
        <span>Already registered? <a href="login.php">Log in</a> to continue.</span>

        
        
        </form>
    
    </div>
    
    </header>
    
    
    </body>
    
</html>