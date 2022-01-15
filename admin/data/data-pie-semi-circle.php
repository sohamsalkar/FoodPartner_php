<?php
#Pie Semi Circle Chart
include('../../inc/config/config.php');

$timestamp = $current_date . ' 00:00:00';
$timestamp1 = $current_date . ' 23:59:59';
//echo $timestamp;
$result = mysqli_query($conn, "SELECT COUNT(u_id) FROM users WHERE `date` BETWEEN '" . $timestamp . "' AND '" . $timestamp1 . "'");
$c = $result->fetch_assoc();
$n = $c['COUNT(u_id)'];
//echo $n;

$result1 = mysqli_query($conn, "SELECT COUNT(u_id) FROM users");
$c1 = $result1->fetch_assoc();
$o=$c1['COUNT(u_id)']-$c['COUNT(u_id)'];
//echo $o;


//$rows = array();
$rows['type'] = 'pie';
$rows['name'] = 'Numbers';
$rows['innerSize'] = '50%';
$rows['data'][] = array('Old Customers', $o);
$rows['data'][] = array('New Customers', $n);
$rslt = array();
array_push($rslt, $rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysqli_close($conn);
