<?php
//print_r($_GET);
//print_r($_POST); 
$txn_type = $_POST['txn_type'];
$payer_id = $_POST['payer_id'];
$payer_mail = $_POST['payer_email'];

$servername = "localhost";
$username = "root";
$password = "is@@c801";
$dbname = "scoreonline";
/*
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT payer_id FROM `users` WHERE user_email LIKE '$payer_mail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $payer = $row['payer_id'];
    }
} else {
        $payer = "unregistered";
}
$conn->close();
*/
$link = mysql_connect('localhost','root','is@@c801');
mysql_select_db('scoreonline', $link);
$sql = "SELECT payer_id FROM `users` WHERE user_email LIKE '$payer_mail'";
$result = mysql_query($sql, $link) or die(mysql_error());
$row = mysql_fetch_assoc($result);
$payer = $row;

if ($payer != $payer_id) {
    $payer = "unregistered";
}
if ($payer = "unregistered") {
    echo "New User <br>";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "INSERT INTO payment_info 
                (`txn_type`, 
                `payer_id`, 
                `payer_mail`) 
            VALUES (
                '$txn_type', 
                '$payer_id', 
                '$payer_mail');";
    if ($conn->query($sql) === TRUE) {
             echo "Payment Registered";
    } else {
            die("Payment Not Registered" . $conn->error);
    }
    $conn->close();
} else {
    echo "Existing User <br>";
}
    echo "Removing some duplicates";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT * FROM `payment_info`
    WHERE payer_id='$payer_id'
    UNION ALL
    SELECT * FROM `payment_info`
    WHERE payer_id='$payer_id'
    ORDER BY txn_type;
    ";
    if ($conn->query($sql) === TRUE) {
             echo "Purged Results";
    } else {
            die("Not Purged Results" . $conn->error);
    }
    $conn->close();
$file = 'people.txt';
$contents = file_get_contents($file);
$contents .= $txn_type;
$contents .= $payer_id;
$contents .= $payer_mail;
file_put_contents($file, $contents);
?>