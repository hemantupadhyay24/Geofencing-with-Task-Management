<?php

include 'DB.php';

date_default_timezone_set('Asia/Kolkata');

function insertTT($conn) {
  $sql  = 'INSERT INTO `TIME_TABLE` (`DAY`, `TIME_SLOT`, `TEACHER_ID`, `SUBJECT`) VALUES
  (\''.$_GET['DAY'].'\', \''.$_GET['TIME_SLOT'].'\', \''.$_GET['ID'].'\', \''.$_GET['SUBJECT'].'\')';

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


function updateTT($conn) {
  $sql  = 'UPDATE `TIME_TABLE` SET `SUBJECT`=\''.$_GET['SUBJECT'].'\' WHERE
  `TIME_SLOT`=\''.$_GET['TIME_SLOT'].'\' AND `DAY`=\''.$_GET['DAY'].'\' AND `TEACHER_ID`=\''.$_GET['ID'].'\'';

  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }
}

function deleteTT($conn) {
  $T1 = "";
  $T2 = "";

  if ($_GET['TIME_SLOT'] == "1-2"){
    $T1 = "12:30-1:30";
    $T2 = "1:30-2:30";
  }elseif ($_GET['TIME_SLOT'] == "12:30-1:30") {
    $T1 = "1-2";
    $T2 = "12-1";
  }elseif ($_GET['TIME_SLOT'] == "1:30-2:30") {
    $T1 = "1-2";
    $T2 = "2-3";
  }

  $sql = "DELETE FROM `TIME_TABLE` WHERE `TEACHER_ID`='".$_GET['ID']."' AND `TIME_SLOT` IN ('".$T1."','".$T2."')";

  if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
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

  deleteTT($conn);
  $sql  = 'SELECT *  FROM `TIME_TABLE` WHERE
  `TIME_SLOT`=\''.$_GET['TIME_SLOT'].'\' AND `DAY`=\''.$_GET['DAY'].'\' AND `TEACHER_ID`=\''.$_GET['ID'].'\'';

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    updateTT($conn);
  } else {
    insertTT($conn);
  }
}

$conn->close();
?>
