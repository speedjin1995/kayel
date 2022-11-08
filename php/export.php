<?php

require_once 'db_connect.php';
// // Load the database configuration file 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Summary_report" . date('Y-m-d') . ".xls";
$output = '';
//$itemType = $_GET['itemType'];
## Search 
$searchQuery = "";

if($_GET['fromDate'] != null && $_GET['fromDate'] != ''){
    $start = date("Y-m-d 00:00:00", strtotime((string)$_GET['fromDate']));
    $searchQuery .= "timestamp >= '".$start."'";
}

if($_GET['toDate'] != null && $_GET['toDate'] != ''){
    $end = date("Y-m-d 23:59:59", strtotime((string)$_GET['toDate']));;
    
    if($_GET['fromDate'] != null && $_GET['fromDate'] != ''){
        $searchQuery .= " AND timestamp <= '".$end."'";
    }
    else{
        $searchQuery .= "timestamp <= '".$end."'";
    }
}

if($_GET['batchNo'] != null && $_GET['batchNo'] != '' && $_GET['batchNo'] != '-'){
    if($_GET['fromDate'] != null && $_GET['fromDate'] != ''){
        $searchQuery .= " AND batch = '".$_GET['batchNo']."'";
    }
    else if($_GET['toDate'] != null && $_GET['toDate'] != ''){
        $searchQuery .= " AND batch = '".$_GET['batchNo']."'";
    }
    else{
        $searchQuery .= "batch = '".$_GET['batchNo']."'";
    }
}
 
// Column names 
$fields = array('TIMESTAMP', 'AIRCOND 1', 'AIRCOND 2', 'COLD CHAMBER', 'HOT WATER 1', 'HOT WATER 2', 'HOT WATER 3', 'LENGTH', 'SAVED LENGTH', 'RPM', 
                'BATCH', 'LAYER', 'THICKNESS 1', 'THICKNESS 2', 'THICKNESS 3'); 

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";
// Fetch records from database
$query = $db->query("SELECT * FROM reading WHERE ".$searchQuery);


if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $parsedDate = date("Y-m-d H:i", strtotime('+8 hours',strtotime($row['timestamp'])));
        $lineData = array($parsedDate, $row['aircond_1'], $row['aircond_2'], $row['chamber'], $row['hot_water_1'], $row['hot_water_2'],
        $row['hot_water_3'], $row['length'], $row['length_saved'], $row['rpm'], $row['batch'], $row['layer'], $row['sensor_1'], $row['sensor_2'], $row['sensor_3']);       

        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
?>
