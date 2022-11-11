<?php
require_once 'db_connect.php';

if(isset($_POST['startDate'], $_POST['endDate'])){
    $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
    $fromDate = new DateTime($startDate);
    $start = date_format($fromDate, "Y-m-d 00:00:00");
	$endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
    $toDate = new DateTime($endDate);
    $end= date_format($toDate,"Y-m-d 23:59:59");

    $empQuery = "SELECT * from reading WHERE timestamp >= '".$start."' AND timestamp <= '".$end."' ORDER BY timestamp";
    $empRecords = mysqli_query($db, $empQuery);
    $data = array();
    $count = 0;

    while($row = mysqli_fetch_assoc($empRecords)) {
        $start = date("Y-m-d H:i", strtotime('+8 hours',strtotime($row['timestamp'])));

        $data[] = array( 
            "timestamp"=>$start,
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
            "layer"=>$row['layer'],
            "width_1"=>$row['width_1'],
            "width_2"=>$row['width_2']
        );
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