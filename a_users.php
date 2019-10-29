<?php
	session_start();
	$uname = $_SESSION['username'];
	$pass = $_SESSION['password'];
	$_SESSION['username'] = $uname;
	$_SESSION['password'] = $pass;
	
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn , 'registers');
	
	$s = "Select * from registrations ";
	$result = mysqli_query( $conn , $s );
?>


<html>
	<head>
		<title>Welcome Admin</title>
		<link href="userstyle.css" type='text/css' rel='stylesheet'>
	</head>
	
	<body>
	<div class ='welcome_admin'>
		<header>
			<div class="homenav">
			<div class='head'> Welcome <?php echo $uname ; ?>! </div>
			<a href="login.php">Sign out</a>
			<a href="a_users.php" class="active">Users</a>
			<a href="admin.php">Job Requests</a>
			</div>
			
			<div class='jbar'>
			<div class = 'jnav'>Users</div>
			<a href="javascript: openSignup()">Add User</a>
			</div>
	
		
			
			<div id='jt'>
			<table style="border: 0px solid #282929; overflow-y: scroll; width: 80%;  margin-top: 10px; margin-left: 10%; color: white;"  border="0" align="left" class='jt' >
				<thead>
					<tr style="background-color: #282929; font-size: 30px; color: white;" >
						<th><span>Username</span></th>
						<th><span>Balance</span></th>
						<th>Delete User</th>
					</tr>
				</thead>
				<tbody>
					<?php $dict1 = array(); $i =1 ; while ($r = mysqli_fetch_array($result)) { echo "<tr style='font-size: 18px; color: white '>"."<td align='center'>".$r['uname']."</td>"."<td align='center'>".$r['bal']."<td align='center'><button type='button' id='btn' style='background: none; border-color: white; color: white; cursor: pointer; border-radius: 3px; padding: 3px 5px;' value='$i' name='delete' id='$i' onclick='delete_user($i);'>Delete</button></td>"."</tr>"; $dict1[$i] = $r['uname'] ; $i++; } ?>
				</tbody>
			</table>
			</div>
			
			
		</header>
		</div>
		
		<?php $_SESSION['dict1'] = $dict1; ?>
		
	<script language='javascript'>
	
	
		function openSignup() {
			window.open("signup.php");
		}
		
		function delete_user(x) {
			var xhttp;
			
			if (window.XMLHttpRequest)
			{
				xhttp = new XMLHttpRequest();
			}
			else
			{
				xhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xhttp.onreadystatechange = function() {
				if ( this.readyState == 4 && this.status == 200 ) {
					document.location.reload(true);
				}
			};
			
			xhttp.open("GET","delete_user.php?u_id=" +x , true);
			xhttp.send(null);
			
			
		}
		

	</script>
	
	</body>
	
</html>