<?php

/*include 'DB.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id FROM TEACHER";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " .$row["id"]. "<br>";
    }
} else {
    echo "{}";
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$HELLO = 'HI HELLO ' . generateRandomString() . " HDHDHD";

ECHO $HELLO;

mysqli_close($conn);*/

/*$arr = array();
$arr["haha"] = 'lala';
$arr["yolo"] = 'swag';

print json_encode($arr);*/

echo date('d/m/Y');

?>
