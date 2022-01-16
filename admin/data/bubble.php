<?php
#Pie Chart
//echo $timestamp;
$timestamp = $current_date . ' 00:00:00';
$timestamp1 = $current_date . ' 23:59:59';
$p = array();
$dataPoints=array();
$result12 = mysqli_query($conn, "SELECT * FROM `orders` WHERE `date` BETWEEN '" . $timestamp . "' AND '" . $timestamp1 . "'");
while ($chr = mysqli_fetch_array($result12)) {

    $datertime = explode(" ",$chr['date']);
    $date2 = $datertime[0];
    $time2 = $datertime[1];
    $tarr=explode(":",$time2);
    $tar=$tarr[0].".".$tarr[1].$tarr[2];
    //echo $time;
    $p = array("name" =>"$chr[order_id]", "x" => "$tar", "y" =>"$chr[total_price]", "z" =>"$chr[total_price]");
    array_push($dataPoints,$p);
}

//print json_encode($dataPoints, JSON_NUMERIC_CHECK);

?>