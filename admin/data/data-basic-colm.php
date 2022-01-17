<?php
include('../../inc/config/config.php');

$couu = array();
$bln = array();
$bln['name'] = 'Date';
$rows['name'] = 'Count';
$i = 1;
while ($i <= 31) {
    $couu[$i] = 0;
    $i++;
}
$result123 = mysqli_query($conn, "SELECT * FROM `orders` ");
while ($chrr = mysqli_fetch_array($result123)) {
    $datertime1 = explode(" ", $chrr['date']);
    $date12 = $datertime1[0];
    $darr = explode("-", $date12);
    //$num = intval("10");
    $datee = (int) $darr[2];
    //echo $couu[$datee].'<br>'.'after adding<br>'; 
    $couu[$datee] = $couu[$datee] + 1;
    //echo $couu[$datee].'<br>'; 
}

$i = 1;
while ($i <= 31) {
    $bln['data'][]=$i;
    $rows['data'][]=$couu[$i];
    $i++;
}



$rslt1 = array();
array_push($rslt1, $bln);
array_push($rslt1, $rows);
print json_encode($rslt1, JSON_NUMERIC_CHECK);

mysqli_close($conn);
