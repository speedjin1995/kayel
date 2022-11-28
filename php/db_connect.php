<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
$db = mysqli_connect("localhost", "root", "root", "u782565293_kayel");
//$db = mysqli_connect("sql364.main-hosting.eu", "u782565293_kayel", "Aaa111222333", "u782565293_kayel");

if(mysqli_connect_errno()){
    echo 'Database connection failed with following errors: ' . mysqli_connect_error();
    die();
}
?>