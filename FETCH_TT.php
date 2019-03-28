<?php

include 'DB.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql  = 'SELECT *  FROM `TIME_TABLE` WHERE `DAY` LIKE \''.$_GET['DAY'].'\'
AND `TEACHER_ID` LIKE \''.$_GET['TEACHER_ID'].'\' ORDER BY TIME_SLOT';

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    print json_encode($rows);
} else {
    echo "{}";
}

mysqli_close($conn);
?>
