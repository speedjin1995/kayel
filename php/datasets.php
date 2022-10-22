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
                    "aircond_1"=>$row['aircond_1'],
                    "aircond_2"=>$row['aircond_2'],
                    "chamber"=>$row['chamber'],
                    "hot_water_1"=>$row['hot_water_1'],
                    "hot_water_2"=>$row['hot_water_2'],
                    "hot_water_3"=>$row['hot_water_3'],
                    "length"=>$row['length'],
                    "rpm"=>$row['rpm'],
                    "batch"=>$row['batch'],
                    "length_saved"=>$row['length_saved'],
                    "sensor_1"=>$row['sensor_1'],
                    "sensor_2"=>$row['sensor_2'],
                    "sensor_3"=>$row['sensor_3'],
                    "layer"=>$row['layer']
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
                    "aircond_1"=>$row['aircond_1'],
                    "aircond_2"=>$row['aircond_2'],
                    "chamber"=>$row['chamber'],
                    "hot_water_1"=>$row['hot_water_1'],
                    "hot_water_2"=>$row['hot_water_2'],
                    "hot_water_3"=>$row['hot_water_3'],
                    "length"=>$row['length'],
                    "rpm"=>$row['rpm'],
                    "batch"=>$row['batch'],
                    "length_saved"=>$row['length_saved'],
                    "sensor_1"=>$row['sensor_1'],
                    "sensor_2"=>$row['sensor_2'],
                    "sensor_3"=>$row['sensor_3'],
                    "layer"=>$row['layer']
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
                    "aircond_1"=>$row['aircond_1'],
                    "aircond_2"=>$row['aircond_2'],
                    "chamber"=>$row['chamber'],
                    "hot_water_1"=>$row['hot_water_1'],
                    "hot_water_2"=>$row['hot_water_2'],
                    "hot_water_3"=>$row['hot_water_3'],
                    "length"=>$row['length'],
                    "rpm"=>$row['rpm'],
                    "batch"=>$row['batch'],
                    "length_saved"=>$row['length_saved'],
                    "sensor_1"=>$row['sensor_1'],
                    "sensor_2"=>$row['sensor_2'],
                    "sensor_3"=>$row['sensor_3'],
                    "layer"=>$row['layer']
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
                    "aircond_1"=>$row['aircond_1'],
                    "aircond_2"=>$row['aircond_2'],
                    "chamber"=>$row['chamber'],
                    "hot_water_1"=>$row['hot_water_1'],
                    "hot_water_2"=>$row['hot_water_2'],
                    "hot_water_3"=>$row['hot_water_3'],
                    "length"=>$row['length'],
                    "rpm"=>$row['rpm'],
                    "batch"=>$row['batch'],
                    "length_saved"=>$row['length_saved'],
                    "sensor_1"=>$row['sensor_1'],
                    "sensor_2"=>$row['sensor_2'],
                    "sensor_3"=>$row['sensor_3'],
                    "layer"=>$row['layer']
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
                    "aircond_1"=>$row['aircond_1'],
                    "aircond_2"=>$row['aircond_2'],
                    "chamber"=>$row['chamber'],
                    "hot_water_1"=>$row['hot_water_1'],
                    "hot_water_2"=>$row['hot_water_2'],
                    "hot_water_3"=>$row['hot_water_3'],
                    "length"=>$row['length'],
                    "rpm"=>$row['rpm'],
                    "batch"=>$row['batch'],
                    "length_saved"=>$row['length_saved'],
                    "sensor_1"=>$row['sensor_1'],
                    "sensor_2"=>$row['sensor_2'],
                    "sensor_3"=>$row['sensor_3'],
                    "layer"=>$row['layer']
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