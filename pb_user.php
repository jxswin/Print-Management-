<?php
	
	session_start();
	$uname = $_SESSION['username'];
	$pass = $_SESSION['password'];
	$_SESSION['username'] = $uname;
	$_SESSION['password'] = $pass;
	
?>


<html>
	<head>
		<title>Welcome User</title>
		<link href="userstyle.css" type='text/css' rel='stylesheet'>
	</head>
	
	<body>
	
	<div class ='welcome_user'>
		<header>
			<div class="homenav">
			<div class='head'> Welcome <?php echo $uname ; ?>! </div>
			<a href="login.php">Sign out</a>
			<a href="" class="active">Printing Balance</a>
			<a href="user.php">Jobs</a>
			</div>
			
			
			<div class='balance' align = 'center'>
				<div>Your Printing balance is :</div>
				<?php 	$conn = mysqli_connect('localhost','root','');
						mysqli_select_db($conn , 'registers');
						
						$s="Select bal from registrations where uname='$uname' ";
						$res = mysqli_query($conn , $s);
						
						while ($r = mysqli_fetch_array($res)) {
							$GLOBALS['ob'] = $r['bal'];
							echo "<h2>".$r['bal']."</h2>";
						}
				?>
				<button type='button' id='recharge' onclick='javascript:recharge_bal();' align = 'center' style="margin-top: 5px;">Recharge</button>
			</div>
			
			<div class='rform' id='rform' >
				
				<form class='bal' method="POST" action=''>
					<div align='center' >
					<label style=" margin-bottom:20px; font-size: 20px;"><b>Please enter the amount you want to recharge with :<b></label><br>
					<input type='text' name='recharge' placeholder='Enter Recharge amount' style='margin-top:20px;padding:10px 5px; background: #f1f1f1;'required><br><br><br>
					<input type='submit' name='submit' id='submit'>
					<button type='button' id='cancel' onclick='javascript:close_f();' style="margin-top: 5px;">Cancel</button>
					</div>
				</form>
			</div>
			
		</header>
		</div>
		
		<?php 
		
			if(isset($_POST['submit']))
			{
				$b = $_POST['recharge'];
				$newb = $GLOBALS['ob'] + $b;
				$rec = "update registrations set bal = '$newb' where uname = '$uname' ";
				$c = mysqli_query($conn , $rec);
				
				echo "<scipt language='javascript'> alert('Recharge successful'); </script>";
				header("Refresh:0");
			}
		?>
		
		<script>
			
			function recharge_bal() {
				document.getElementById("rform").style.display = "block" ;
			}
			
			function close_f() {
				document.getElementById("rform").style.display = "none";
			}
		
		</script>
		
	</body>
</html>

