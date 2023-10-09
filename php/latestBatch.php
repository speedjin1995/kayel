<?php
require_once 'db_connect.php';

$empQuery = "SELECT * from reading ORDER BY timestamp DESC LIMIT 1";
$empRecords = mysqli_query($db, $empQuery);
$message = array();
$count = 0;

if($row = mysqli_fetch_assoc($empRecords)) {
    $message['lot_no'] = $row['lot_no'];
}

echo json_encode(
    array(
        "status"=> "success", 
        "message"=> $message
    )
);
?>