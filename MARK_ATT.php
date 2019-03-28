<?php

include 'DB.php';

date_default_timezone_set('Asia/Kolkata');

function insertATT($conn) {
  $sql  = 'INSERT INTO `ATTENDANCE` (`DATE`, `TIME_STAMP`, `TEACHER_ID`) VALUES
  (\''.date('d/m/Y').'\', \''.date('H:i').'\', \''.$_GET['ID'].'\')';

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function updateATT($conn) {
  $sql = "UPDATE `ATTENDANCE` SET `TIME_STAMP_OUT`='' WHERE `TEACHER_ID`='".$_GET['ID']."'";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql  = 'SELECT *  FROM `TEACHER` WHERE `ID` LIKE \''.$_GET['ID'].'\'';

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

  $sql  = 'SELECT * FROM `ATTENDANCE` WHERE `DATE`=\''.date('d/m/Y').'\' AND `TEACHER_ID`=\''.$_GET['ID'].'\'';

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    updateATT($conn);
  } else {
    insertATT($conn);
  }
}

$conn->close();
?>
