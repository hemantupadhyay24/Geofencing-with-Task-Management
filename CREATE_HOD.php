<?php

include 'DB.php';
$msg = '';

$conn = mysqli_connect($servername, $username, $password, $dbname);

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

// Create connection
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($_GET['NAME'] != ''){

  //$sql = "INSERT INTO `TEACHER` (`ID`, `NAME`, `USERNAME`, `PASSWORD`, `DEPARTMENT_ID`)
  //VALUES ('".generateRandomString().'\', \''.$_GET['NAME'].'\', \''.$_GET['USERNAME'].'\', \''.$_GET['PASSWORD'].'\', \''.$_GET['DEPARTMENT_ID'].'\')';

  $sql = "SELECT * FROM 	`DEPARTMENT` WHERE `ID`=\"".$_GET['DEPARTMENT_ID']."\"";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $ID = generateRandomString();
    $sql = "INSERT INTO `TEACHER` (`ID`, `NAME`, `USERNAME`, `PASSWORD`, `DEPARTMENT_ID`)
    VALUES ('".$ID.'\', \''.$_GET['NAME'].'\', \''.$_GET['USERNAME'].'\', \''.$_GET['PASSWORD'].'\', \''.$_GET['DEPARTMENT_ID'].'\')';

    if (mysqli_query($conn, $sql)) {

      $sql = "UPDATE `DEPARTMENT` SET `ID`='".$ID."' WHERE `ID`='".$_GET['DEPARTMENT_ID']."''";

      if (mysqli_query($conn, $sql)) {
        $msg = "HOD Created Successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  } else {
    $ID = generateRandomString();
    $sql = "INSERT INTO `TEACHER` (`ID`, `NAME`, `USERNAME`, `PASSWORD`, `DEPARTMENT_ID`)
    VALUES ('".$ID.'\', \''.$_GET['NAME'].'\', \''.$_GET['USERNAME'].'\', \''.$_GET['PASSWORD'].'\', \''.$_GET['DEPARTMENT_ID'].'\')';

    if (mysqli_query($conn, $sql)) {

      $sql = "INSERT INTO `DEPARTMENT` (`HOD_ID`, `ID`) VALUES ('".$ID."', '".$_GET['DEPARTMENT_ID']."')";

      if (mysqli_query($conn, $sql)) {
        $msg = "HOD Created Successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }

}


$sql = "SELECT `ID` FROM 	`DEPARTMENT`";

echo'<html>
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
<h3>Create HOD</h3>

<form method="get" action="CREATE_HOD.php">
<div class="col uniform">

<div class="6u 12u$(xsmall)">
<input type="text" name="NAME" id="NAME" value="" placeholder="Name" />
</div>
<br>
<div class="6u 12u$(xsmall)">
<input type="text" name="USERNAME" id="USERNAME" value="" placeholder="Username" />
</div>
<br>
<div class="6u 12u$(xsmall)">
<input type="password" name="PASSWORD" id="PASSWORD" value="" placeholder="Password" />
</div>
<br>
<div class="6u 12u$(xsmall)">
<input type="text" name="DEPARTMENT_ID" id="DEPARTMENT_ID" value="" placeholder="Department" />
</div>
<br>


<div class="12u$">
<ul class="actions">
<li><input type="submit" value="Create" class="special" /></li>
<li><input type="reset" value="Reset" /></li>
</ul>
</div>
<h3>'.$msg.'</h3>


</div>
</form>

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


          <!-- <li>
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
';

mysqli_close($conn);

?>
