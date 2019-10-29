<?php
	ob_start();
	session_start();
	$uname = $_SESSION['username'];
	$pass = $_SESSION['password'];
	$_SESSION['username'] = $uname;
	$_SESSION['password'] = $pass;
	
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn , 'registers');
	
	$s = "select jname,exp,approved,cost from jobs where uname = '$uname' ";
	$result = mysqli_query($conn , $s);
	
	$rs="Select bal from registrations where uname='$uname' ";
	$res = mysqli_query($conn , $rs);
	while ($r = mysqli_fetch_array($res)) {
		$GLOBALS['ob'] = $r['bal'];
	}
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
			<a href="pb_user.php">Printing Balance</a>
			<a href="" class='active'>Jobs</a>
			</div>

			<div class = 'jbar'>
				<div class = 'jnav'>Job Requests</div>
				<a href="javascript: open_dlist()">Delete Job</a>
				<a href="javascript: openForm()" >Add Job</a>
			</div>
			
			<div id='jt'>
			<table style="border: 0px; overflow-y: scroll; width: 90%;  margin-top: 10px; color: white;"  border="0", align="center" class='jt' >
				<thead>
					<tr style="background-color: #282929; font-size: 20px; color: white;" >
						<th><span>Jobs</span></th>
						<th><span>Due Date</span></th>
						<th><span>Cost(Rs.)</span></th>
						<th><span>Approved/Not Approved</span></th>
					</tr>
				</thead>
				<tbody>
					<?php $dict_jobs = array(); $a =1 ; while ($r = mysqli_fetch_array($result)) { echo "<tr style='font-size: 18px; color: white '>"."<td align='center'>".$r['jname']."</td>"."<td align='center'>".$r['exp']."</td>"."<td align='center'>".$r['cost']."</td>"."<td align='center'>".$r['approved']."</td>"."</tr>";$dict_jobs[$a] = $r['jname'] ;$a++;  } ?>
				</tbody>
			</table>
			</div>
					
			<div class = 'add_j' id='jform' style="width: 300px; position: fixed; top: 20%; right: 20px;">
				<form class='a_job' method='POST' action="">
					<label ><b>Job name<b></label><br>
					<input type='text' name='jname' placeholder='Enter Job name' required><br><br>
					
					<label ><b>Completion Date<b></label><br>
					<input type='date' name='exp' placeholder='Enter the date' required><br><br>
					
					<label for='cost'><b>Printing Cost<b></label><br>
					<input type='text' name='cost' placeholder='Enter Printing cost' required><br><br>
					
					<label for='cost'><b>Upload File<b></label><br>
					<input type='file' name='ufile' placeholder='' required><br>
					
					<br><br><br>
					<input type='submit' name='submit' id='submit'>
					<button type='button' id='cancel' onclick='javascript:closeForm();' style="margin-top: 5px;">Cancel</button>
				</form>
			</div>
			
			<div class = 'del_j' id='djlist' style="width: 300px; heigth: 700px; position: fixed; top: 20%; right: 20px; background:#888;display:none; overflow-y:scroll; color:black; cursor: move;">
				<form class='d_job' method='POST' action="">
					<?php $i = 1;  $result = mysqli_query($conn , $s); while($row = mysqli_fetch_array($result)) { echo "<input style='margin-left: 5%; margin-top: 5%; margin-bottom: 5%; color: black;' type='checkbox' value='$i' name='job[]'>".$row['jname']."<br>"; $i++ ; } ?>
					<input type='submit' name='submit1' id='submit1'>
					<button type='button' id='cancel1' onclick='javascript:close_dlist();' style="margin-top: 5px;">Cancel</button>
				</form>
			</div>
			
			
			</header>	
		</div>
		
		<?php 
			
			if (isset($_POST['submit']))
			{
				echo "<script type='text/javascript' > closeForm() </script>";
				$jname = $_POST['jname'];
				$cost = $_POST['cost'];
				$exp = $_POST['exp'];
				$st = "select * from registrations where jname = '$jname' ";
				$res = mysqli_query($s);
				$n = mysqli_affected_rows($res);
				if ($n == 1)
				{
					echo "<script language='javascript'> alert('Job with this name already exists'); </script>";
					header("Refresh:0");
				}
				else
				{
					if ( $cost <= $GLOBALS['ob'] )
					{
						$t = "insert into jobs values ('$uname','$jname','$exp','$cost','not approved')";
						mysqli_query($conn , $t);
						$newb = $GLOBALS['ob'] - $cost;
						$rec = "update registrations set bal = '$newb' where uname = '$uname' ";
						$c = mysqli_query($conn , $rec);
						echo '<script language="javascript">';
						echo 'alert("Job added successfully")';
						echo '</script>';
						header("Refresh:0");
					}
					else
					{
						echo "<script language='javascript'> alert('Cannot place a request due to insufficient balance'); </script>";
						header("Refresh:0");
					}
				}
			}
		?>
		
		<?php
			if (isset($_POST['submit1']))
			{
				echo "<script type='text/javascript' > close_dlist() </script>";
				$j_array = array();
				
				if (!empty ($_POST["job"]))
				{
					foreach($_POST['job'] as $j ) {
						array_push($j_array , $dict_jobs[$j]);
					}
				}
				
				foreach ( $j_array as $jn) {
					$delete = " Delete from jobs where jname = '$jn' ";
					$deleted = mysqli_query( $conn , $delete );
				}
				echo '<script language="javascript">';
				echo 'alert("Deleted Selected Jobs successfully")';
				echo '</script>';
				header("Refresh:0");
			}
			
			ob_end_flush();
		?>
		
		
	<script>
		function openForm() {
			document.getElementById("jform").style.display = "block";
		}
		function closeForm() {
			document.getElementById("jform").style.display= "none";
		}
		
		function open_dlist() {
			document.getElementById("djlist").style.display = "block";
		}
		
		function close_dlist() {
			document.getElementById("djlist").style.display = "none" ;
		}
		
	</script>	
	
	</body>
</html>