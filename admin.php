<?php
	session_start();
	$uname = $_SESSION['username'];
	$pass = $_SESSION['password'];
	$_SESSION['username'] = $uname;
	$_SESSION['password'] = $pass;
	
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn , 'registers');

	
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
			<a href="login.php" >Sign out</a>
			<a href="a_users.php">Users</a>
			<a href="" class="active">Job Requests</a>
			</div>
			
			<div class='jbar'>
			<div class = 'jnav'>Pending Job Requests</div>
			</div>

			<div id='jt'>
			<table style="border: 0px; overflow-y: scroll; width: 90%;  margin-top: 10px; color: white;"  border="0", align="center" class='jt' >
				<thead>
					<tr style="background-color: #282929; font-size: 20px; color: white;" >
						<th><span>Username</span></th>
						<th><span>Jobs</span></th>
						<th><span>Due Date</span></th>
						<th><span>Cost(Rs.)</span></th>
						<th><span>Approved/Not Approved</span></th>
					</tr>
				</thead>
				<tbody>
					<?php $s = "select * from jobs where approved = 'not approved' " ; $result_na = mysqli_query( $conn, $s); $n = mysqli_affected_rows($conn); if($n == 0){ echo "<tr style='font-size: 18px; color: white ;'><td align='center'>-</td><td align='center'>-</td><td align='center'>-</td><td align='center'>-</td><td align='center'>-</td></tr>"; } ?>
					<?php $dict_ujobs = array(); $i =1 ; while ($r = mysqli_fetch_array($result_na)) { echo "<tr style='font-size: 18px; color: white '>"."<td align='center'>".$r['uname']."</td>"."<td align='center'>".$r['jname']."</td>"."<td align='center'>".$r['exp']."</td>"."<td align='center'>".$r['cost']."</td>"."<td align='center'><button type='button' value='$i' name='approve' id='$i' style='background: none; border-color: white; color: white; cursor: pointer; border-radius: 3px; padding: 3px 5px;' onclick='javascript:approve_user($i)'>Approve</button></td>"."</tr>"; $dict_ujobs[$i] = $r['uname'] ; $i++; } ?>
				</tbody>
			</table>
			</div>
			
			
			<div class='jbar'>
			<div class = 'jnav'>Approved Job Requests</div>
			</div>

			<table style="border: 0px solid #282929; overflow-y: scroll; width: 80%;  margin-top: 10px; margin-left: 10%; color: white;"  border="0" align="left" class='jt' >
				<thead>
					<tr style="background-color: #282929; font-size: 18px; color: white;" >
						<th><span>Username</span></th>
						<th><span>Job name</span></th>
						<th><span>Due Date</span></th>
						<th><span>Cost(Rs.)</span></th>
					</tr>
				</thead>
				<tbody>
				<?php $t = "select * from jobs where approved = 'approved' " ; $result_a = mysqli_query( $conn, $t); $n = mysqli_affected_rows($conn); if($n == 0){ echo "<tr style='font-size: 18px; color: white ;'><td align='center'>-</td><td align='center'>-</td><td align='center'>-</td><td align='center'>-</td><td align='center'>-</td></tr>"; } ?>
					<?php while ($r = mysqli_fetch_array($result_a)) { echo "<tr style='font-size: 18px; color: white '>"."<td align='center'>".$r['uname']."</td>"."<td align='center'>".$r['jname']."</td>"."<td align='center'>".$r['exp']."</td>"."<td align='center'>".$r['cost']."</td>"."</tr>";  } ?>
				</tbody>
			</table>
			</div>
			
		</header>
		</div>
	</body>
	
	

	<script>
	function approve_user(x) {
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
			
			xhttp.open("GET","approve_user.php?u_id=" +x , true);
			xhttp.send(null);
			
			
		}
	
	</script>
	
    <?php $_SESSION['dict_ujobs'] = $dict_ujobs; ?>

</html>