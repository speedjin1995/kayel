<?php
require_once 'db_connect.php';

if(isset($_POST['startDate'], $_POST['endDate'], $_POST['duration'])){
    $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
    $startDate = date_format($startDate,"Y-m-d H:i:s");
	$endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
    $endDate = date_format($endDate,"Y-m-d H:i:s");
    $duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING);

    $empQuery = "SELECT * from reading WHERE timestamp >= '".$startDate."' AND timestamp <= '".$endDate." ORDER BY timestamp";
    $empRecords = mysqli_query($db, $empQuery);
    $data = array();
    int $count = 0;

    if($duration == 1){
        if($count % 2 == 0){
            while($row = mysqli_fetch_assoc($empRecords)) {
                $data[] = array( 
                    "timestamp"=>$row['timestamp'],
                    "address_1"=>$row['address_1'],
                    "address_2"=>$row['address_2'],
                    "address_3"=>$row['address_3'],
                    "address_4"=>$row['address_4'],
                    "address_5"=>$row['address_5'],
                    "address_6"=>$row['address_6'],
                    "length"=>$row['length'],
                    "sensor"=>$row['sensor']
                );
            }

            $count = $count + 1;
        }
    }
    else if($duration == 5){
        if($count % 10 == 0){
            while($row = mysqli_fetch_assoc($empRecords)) {
                $data[] = array( 
                    "timestamp"=>$row['timestamp'],
                    "address_1"=>$row['address_1'],
                    "address_2"=>$row['address_2'],
                    "address_3"=>$row['address_3'],
                    "address_4"=>$row['address_4'],
                    "address_5"=>$row['address_5'],
                    "address_6"=>$row['address_6'],
                    "length"=>$row['length'],
                    "sensor"=>$row['sensor']
                );
            }

            $count = $count + 1;
        }
    }
    else if($duration == 10){
        if($count % 20 == 0){
            while($row = mysqli_fetch_assoc($empRecords)) {
                $data[] = array( 
                    "timestamp"=>$row['timestamp'],
                    "address_1"=>$row['address_1'],
                    "address_2"=>$row['address_2'],
                    "address_3"=>$row['address_3'],
                    "address_4"=>$row['address_4'],
                    "address_5"=>$row['address_5'],
                    "address_6"=>$row['address_6'],
                    "length"=>$row['length'],
                    "sensor"=>$row['sensor']
                );
            }

            $count = $count + 1;
        }
    }
    else if($duration == 30){
        if($count % 60 == 0){
            while($row = mysqli_fetch_assoc($empRecords)) {
                $data[] = array( 
                    "timestamp"=>$row['timestamp'],
                    "address_1"=>$row['address_1'],
                    "address_2"=>$row['address_2'],
                    "address_3"=>$row['address_3'],
                    "address_4"=>$row['address_4'],
                    "address_5"=>$row['address_5'],
                    "address_6"=>$row['address_6'],
                    "length"=>$row['length'],
                    "sensor"=>$row['sensor']
                );
            }

            $count = $count + 1;
        }
    }
    else if($duration == 60){
        if($count % 120 == 0){
            while($row = mysqli_fetch_assoc($empRecords)) {
                $data[] = array( 
                    "timestamp"=>$row['timestamp'],
                    "address_1"=>$row['address_1'],
                    "address_2"=>$row['address_2'],
                    "address_3"=>$row['address_3'],
                    "address_4"=>$row['address_4'],
                    "address_5"=>$row['address_5'],
                    "address_6"=>$row['address_6'],
                    "length"=>$row['length'],
                    "sensor"=>$row['sensor']
                );
            }

            $count = $count + 1;
        }
    }

    echo json_encode(
        array(
            "status"=> "success", 
            "message"=> $data
        )
    );
}
else{
    echo json_encode(
        array(
            "status"=> "failed", 
            "message"=> "Please fill in all the fields"
        )
    );
}
?>