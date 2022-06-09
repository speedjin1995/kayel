<?php
require_once 'db_connect.php';

if(isset($_POST['startDate'], $_POST['endDate'], $_POST['duration'])){
    $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
    $fromDate = new DateTime($startDate);
    $start = date_format($fromDate, "Y-m-d H:i:s");
	$endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
    $toDate = new DateTime($endDate);
    $end= date_format($toDate,"Y-m-d 23:59:59");
    $duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_STRING);

    $empQuery = "SELECT * from reading WHERE timestamp >= '".$start."' AND timestamp <= '".$end."' ORDER BY timestamp";
    $empRecords = mysqli_query($db, $empQuery);
    $data = array();
    $count = 0;

    if($duration == 1){
        while($row = mysqli_fetch_assoc($empRecords)) {
            if($count % 2 == 0){

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
        while($row = mysqli_fetch_assoc($empRecords)) {
            if($count % 10 == 0){
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
        while($row = mysqli_fetch_assoc($empRecords)) {
            if($count % 20 == 0){

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
        while($row = mysqli_fetch_assoc($empRecords)) {
            if($count % 60 == 0){
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
        while($row = mysqli_fetch_assoc($empRecords)) {
            if($count % 120 == 0){

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