<?php
require_once 'db_connect.php';

if(isset($_POST['aircond_1'], $_POST['aircond_2'], $_POST['chamber'], $_POST['hot_water_1'], $_POST['hot_water_2'], $_POST['hot_water_3'],
$_POST['length'], $_POST['rpm'], $_POST['batch'], $_POST['length_saved'], $_POST['sensor_1'], $_POST['sensor_2'], $_POST['sensor_3'],
$_POST['layer'], $_POST['width_1'], $_POST['width_2'])){
    $aircond_1 = filter_input(INPUT_POST, 'aircond_1', FILTER_SANITIZE_STRING);
    $aircond_2 = filter_input(INPUT_POST, 'aircond_2', FILTER_SANITIZE_STRING);
    $chamber = filter_input(INPUT_POST, 'chamber', FILTER_SANITIZE_STRING);
    $hot_water_1 = filter_input(INPUT_POST, 'hot_water_1', FILTER_SANITIZE_STRING);
    $hot_water_2 = filter_input(INPUT_POST, 'hot_water_2', FILTER_SANITIZE_STRING);
    $hot_water_3 = filter_input(INPUT_POST, 'hot_water_3', FILTER_SANITIZE_STRING);
    $length = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_STRING);
    $rpm = filter_input(INPUT_POST, 'rpm', FILTER_SANITIZE_STRING);
    $batch = filter_input(INPUT_POST, 'batch', FILTER_SANITIZE_STRING);
    $length_saved = filter_input(INPUT_POST, 'length_saved', FILTER_SANITIZE_STRING);
    $sensor_1 = filter_input(INPUT_POST, 'sensor_1', FILTER_SANITIZE_STRING);
    $sensor_2 = filter_input(INPUT_POST, 'sensor_2', FILTER_SANITIZE_STRING);
    $sensor_3 = filter_input(INPUT_POST, 'sensor_3', FILTER_SANITIZE_STRING);
    $layer = filter_input(INPUT_POST, 'layer', FILTER_SANITIZE_STRING);
    $width_1 = filter_input(INPUT_POST, 'width_1', FILTER_SANITIZE_STRING);
    $width_2 = filter_input(INPUT_POST, 'width_2', FILTER_SANITIZE_STRING);

    if ($insert_stmt = $db->prepare("INSERT INTO reading (aircond_1, aircond_2, chamber, hot_water_1, hot_water_2, hot_water_3, length, rpm, batch, length_saved, sensor_1, sensor_2, sensor_3, layer, width_1, width_2) VALUES (?, ?, ?, ?, ?, ? ,?, ?, ?, ?, ?, ?, ? ,?, ?, ?)")) {
        $insert_stmt->bind_param('ssssssssssssssss', $aircond_1, $aircond_2, $chamber, $hot_water_1, $hot_water_2, $hot_water_3, $length);
        
        // Execute the prepared query.
        if (! $insert_stmt->execute()) {
            echo json_encode(
                array(
                    "status"=> "failed", 
                    "message"=> $insert_stmt->error
                )
            );
        }
        else{
            echo json_encode(
                array(
                    "status"=> "success", 
                    "message"=> "Successfully insert to db"
                )
            );
        }
    }
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