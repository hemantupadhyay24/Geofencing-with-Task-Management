<?php

include 'DB.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn){die("Connection failed: " . mysqli_connect_error());}

$response = array();

$type = substr($_GET['USERNAME'],0,2);

if($type == 'TR'){
  $sql  = 'SELECT * FROM `TEACHER` WHERE USERNAME = \''.$_GET['USERNAME'].'\' AND PASSWORD = \''.$_GET['PASSWORD'].'\'';
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
      $response['ID']         = $row['ID'];
      $response['NAME']       = $row['NAME'];
      $response['DEPARTMENT'] = $row['DEPARTMENT_ID'];
      break;
    }

    $sql = "SELECT * FROM `DEPARTMENT` WHERE `HOD_ID` = '".$response['ID']."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)){
        $response['TYPE'] = 'HOD';
        break;
      }
    }else{
      $response['TYPE'] = 'TEACHER';
    }
    print json_encode($response);
  }
  else{
    echo "{}";
  }

}
elseif($type == 'CR'){
  $sql  = 'SELECT * FROM `CR` WHERE USERNAME = \''.$_GET['USERNAME'].'\' AND PASSWORD = \''.$_GET['PASSWORD'].'\'';
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
      $response['ID']         = $row['ID'];
      $response['NAME']       = $row['NAME'];
      $response['TYPE']       = 'CR';
      $response['DEPARTMENT'] = $row['DEPARTMENT'];
      break;
    }
    print json_encode($response);
  }
  else{
    echo "{}";
  }
}
elseif($type == 'PR'){
  $sql  = 'SELECT * FROM `PRINCIPAL` WHERE USERNAME = \''.$_GET['USERNAME'].'\' AND PASSWORD = \''.$_GET['PASSWORD'].'\'';
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
      $response['ID']         = $row['ID'];
      $response['NAME']       = $row['NAME'];
      $response['TYPE']       = 'PRINCIPAL';
      $response['DEPARTMENT'] = 'Bandra Polytechnic';
      break;
    }
    print json_encode($response);
  }
  else{
    echo "{}";
  }
}

mysqli_close($conn);
?>
