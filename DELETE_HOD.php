<html>
<head>
	<title>MANAGE ACCOUNTS PORTAL for PRINCIPAL</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Header -->
				<header id="header">
					<a href="index.html" class="logo"><strong>Geo Attendance</strong> by Govt. Polytechnic</a>
				</header>
        <br>
				<h3>Delete HOD</h3>

				<div class="table-wrapper">
					<form action="DELETE_HOD.php" method="get">
						<table>
							<thead>
								<tr>
									<th>USERNAME</th>
									<th>NAME</th>
									<th>HOD OF DEPARTMENT</th>
								</tr>
							</thead>
							<tbody>

								<?php
								include 'DB.php';

								// Create connection
								$conn = mysqli_connect($servername, $username, $password, $dbname);
								// Check connection
								if (!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}

								if(!empty($_GET['check_list'])) {
									foreach($_GET['check_list'] as $check) {
										$sql = "DELETE FROM `TEACHER` WHERE `TEACHER`.`ID` = '".$check."'";
										mysqli_query($conn, $sql);

										$sql = "DELETE FROM `DEPARTMENT` WHERE `HOD_ID` = '".$check."'";
										mysqli_query($conn, $sql);

                    $sql = "DELETE FROM `TIME_TABLE` WHERE TEACHER_ID` = '".$check."'";
                    mysqli_query($conn, $sql);
									}
								}

								$sql = "SELECT * FROM TEACHER WHERE ID IN (SELECT HOD_ID FROM DEPARTMENT) ORDER BY `NAME`, `DEPARTMENT_ID`";

								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {
									// output data of each row
									$rows = array();
									while($row = mysqli_fetch_assoc($result)) {
										echo'
										<tr>
										<td>
										<div class="6u 12u$(small)">
										<input type="checkbox" id="'.$row['ID'].'" name="check_list[]" value="'.$row['ID'].'">
										<label for="'.$row['ID'].'">'.$row['USERNAME'].'</label>
										</div>
										</td>
										<td>'.$row['NAME'].'</td>
										<td>'.$row['DEPARTMENT_ID'].'</td>
										</tr>';
									}
								} else {
								}

								mysqli_close($conn);
								?>
							</tbody>
						</table>
						<input type="submit" value="Delete"/>
					</form>
				</div>


				<!-- Sidebar -->

				 <div id="sidebar">
					<div class="inner">
						<!-- Menu -->
						<nav id="menu">
							<header class="major">
								<h2>Menu</h2>
							</header>
							<ul>
								<!-- <li>
									<span class="opener">Teacher</span>
									<ul>
                    <li><a href="CREATE_TEACHER.php">Create</a></li>
                    <li><a href="DELETE_TEACHER.php">Delete</a></li>
                  </ul>
                </li> -->

                <li>
                  <span class="opener">HOD</span>
                  <ul>
                    <li><a href="CREATE_HOD.php">Create</a></li>
                    <li><a href="DELETE_HOD.php">Delete</a></li>
										<li><a href="view_hod.php">VIEW</a></li>
                  </ul>
                </li>


              <!--  <li>
                  <span class="opener">CR</span>
                  <ul>
                    <li><a href="CREATE_CR.php">Create</a></li>
                    <li><a href="DELETE_CR.php">Delete</a></li>
									</ul>
								</li> -->
							</ul>
						</nav>
						<!-- Section -->
						<section>
							<header class="major">
								<h2>Get in touch</h2>
							</header>
							<ul class="contact">
							<li class="fa-envelope-o"><a href="#">principal@gpmumbai.ac.in</a></li>
							<li class="fa-phone">090290 01925</li>
							<li class="fa-home">49, Kherwadi, A.Y.Jung Marg, Bandra (East), Mumbai, Maharashtra 400051 </li>
							</ul>
							</section>
						</div>
					</div>
				</div>
				<!-- Scripts -->
				<script src="assets/js/jquery.min.js"></script>
				<script src="assets/js/skel.min.js"></script>
				<script src="assets/js/util.js"></script>
				<script src="assets/js/main.js"></script>
			</body>
			</html>
