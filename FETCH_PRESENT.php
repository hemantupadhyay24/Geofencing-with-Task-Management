<?php

include 'DB.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_GET["ID"] == "PRINCIPAL"){
  $sql = "SELECT
          `TEACHER_ID`, `ATTENDANCE`.`TIME_STAMP`, `TEACHER`.`NAME`
          FROM
          `TEACHER`, `ATTENDANCE`, `DEPARTMENT`
          WHERE
          `ATTENDANCE`.`TEACHER_ID` = `TEACHER`.`ID`
          AND `ATTENDANCE`.`TEACHER_ID` = `DEPARTMENT`.`HOD_ID`
          AND `ATTENDANCE`.`TIME_STAMP_OUT`=''
          AND `ATTENDANCE`.`DATE`='".date('d/m/Y')."'";
}else{
  $sql = "SELECT
          `TEACHER_ID`, `ATTENDANCE`.`TIME_STAMP`, `TEACHER`.`NAME`
          FROM
          `TEACHER`, `ATTENDANCE`
          WHERE
          `ATTENDANCE`.`TEACHER_ID` = `TEACHER`.`ID`
          AND `ATTENDANCE`.`TIME_STAMP_OUT`=''
          AND `ATTENDANCE`.`DATE`='".date('d/m/Y')."'
          AND `TEACHER`.`DEPARTMENT_ID`= (SELECT
                                         `TEACHER`.`DEPARTMENT_ID`
                                         FROM
                                         `TEACHER`
                                         WHERE
                                         `TEACHER`.`ID`= '".$_GET["ID"]."')";
}

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
